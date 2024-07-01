<?php

namespace App\Http\Controllers;

use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'logo' => 'mimes:jpeg,bmp,png,jpg|max:500',
			'favicon' => 'mimes:ico,jpeg,bmp,png,jpg|max:200',
        ]);

        $input = $request->all();
        $config_type = $request->config_type;
        $old_configs = Setting::all();

        $boolean_system_setting = config('system.boolean.'.$config_type);

        if($boolean_system_setting){
            foreach($boolean_system_setting as $v){
                $config = Setting::firstOrCreate(['name' => $v]);
                $config->value = 0;
                $config->save();
            }
        }

        foreach($_POST as $key => $value){
            if($key == "_token"){
                continue;
            }

            $data = array();
            $data['value'] = $value;

            $data['updated_at'] = Carbon::now();
            if(Setting::where('name', $key)->exists()){
                Setting::where('name','=',$key)->update($data);
            }else{
                $data['name'] = $key;
                $data['created_at'] = Carbon::now();

                Setting::insert($data);
            }
        }

        if($request->hasFile('logo')) {

            $data = getimagesize($request->file('logo'));
            $width = $data[0];
            $height = $data[0];

            // this is for vps hosting
            $storagePath = $request->file('logo')->store('public/logo');
            $fileName = basename($storagePath);
            
            // if file change then delete old one
            $oldFile = $request->get('oldLogo','');
            if( $oldFile != ''){
                $file_path = "public/logo/".$oldFile;
                Storage::delete($file_path);
            }
 
            $logo['name']='logo';
            $logo['value'] = $fileName;

        } else {

            $logo['name']='logo';
            $logo['value'] = $request->get('oldLogo','');

        }

        if($request->hasFile('favicon')) {

            $host = get_option('host');

            // this is for vps hosting
            $storagePath = $request->file('favicon')->store('public/logo');
            $fileName = basename($storagePath);
            
            // if file change then delete old one
            $oldFile = $request->get('old_favicon','');
            if( $oldFile != ''){
                $file_path = "public/logo/".$oldFile;
                Storage::delete($file_path);
            }

            $data1['name']='favicon';
            $data1['value'] = $fileName;

        } else {
            $data1['name']='favicon';
            $data1['value'] = $request->get('old_favicon','');
            
        }

        if(Setting::where('name', "logo")->exists()){
            Setting::where('name','=',"logo")->update($logo);
        } else {
            $logo['created_at'] = Carbon::now();
            Setting::insert($logo);
        }

        if(Setting::where('name', "favicon")->exists()){
            Setting::where('name','=',"favicon")->update($data1);
        } else {
            $data1['created_at'] = Carbon::now();
            Setting::insert($data1);
        }
        
        return response()->json(['status' => 'success', 'message' => 'Configuration Updated', 'load' => true]);
    }
}
