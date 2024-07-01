<?php 

use App\IdGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

if (!function_exists('get_option')) {
    function get_option($name, $default = null)
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
            $setting = DB::table('settings')->where('name', $name)->get();
            if (!$setting->isEmpty()) {
                return $setting[0]->value;
            }
		}
		
        return $default;
    }
}