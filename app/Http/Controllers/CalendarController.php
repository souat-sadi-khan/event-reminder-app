<?php

namespace App\Http\Controllers;

use App\Calendar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Imports\CalendarImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Fetch the top 10 most recent completed records
        $recentCompletedCalendars  = Calendar::where('is_completed', true)->orderBy('updated_at', 'desc')->take(10)->get();

        // Fetch the top 10 most recent overdue records
        $recentOverdueCalendars = Calendar::where('is_completed', false)->where('end_date', '<', now())->orderBy('end_date', 'desc')->take(10)->get();

        // All upcoming events
        $upcomingEvents = json_encode(Calendar::select('id', 'external_recipients', 'event_reminder_id', 'title', 'notes AS description', DB::raw("CONCAT(start_date, ' ', start_time) as start, CONCAT(end_date, ' ', end_time) as end") )->where('start_date', '>=', now())->orderBy('start_date', 'desc')->get());

        // This week task
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $thisWeekEvents = json_encode(Calendar::select('id', 'external_recipients', 'event_reminder_id', 'title', 'notes AS description', DB::raw("CONCAT(start_date, ' ', start_time) as start, CONCAT(end_date, ' ', end_time) as end") )->whereBetween('start_date', [$startOfWeek, $endOfWeek])->orderBy('start_date', 'desc')->get());

        // All completed events
        $completedEvents = json_encode(Calendar::select('id', 'external_recipients', 'event_reminder_id', 'title', 'notes AS description', DB::raw("CONCAT(start_date, ' ', start_time) as start, CONCAT(end_date, ' ', end_time) as end") )->where('is_completed', true)->orderBy('start_date', 'desc')->get());

        // All overdue events
        $overdueEvents = json_encode(Calendar::select('id', 'external_recipients', 'event_reminder_id', 'title', 'notes AS description', DB::raw("CONCAT(start_date, ' ', start_time) as start, CONCAT(end_date, ' ', end_time) as end") )->where('is_completed', false)->where('end_date', '<', now())->orderBy('start_date', 'desc')->get());

        return view('calendar/index', compact('recentCompletedCalendars', 'recentOverdueCalendars', 'overdueEvents', 'completedEvents', 'thisWeekEvents', 'upcomingEvents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->has('start_date')) {
            $startDate = request()->start_date;
        } else {
            $startDate = date('Y-m-d');
        }
        
        if(request()->has('end_date')) {
            $endDate = request()->end_date;
        } else {
            $endDate = date('Y-m-d');
        }

        return view('calendar/create', compact('startDate', 'endDate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_date' => 'nullable|date',
            'end_time' => 'nullable|date_format:H:i',
            'notes' => 'nullable|string',
            'external_recipients' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);

        $validatedData['event_reminder_id'] = $this->generateEventReminderId();

        Calendar::create($validatedData);
		return response()->json(['status' => 'success', 'load' => true, 'message' => 'Event created successfully.']);
    }

    /**
     * Generating a new event Reminder ID.
     *
     * @return \Illuminate\Http\Response
     */
    private function generateEventReminderId()
    {
        $prefix = get_option('prefix');
        $uniqueId = uniqid($prefix);

        // Ensure the ID is unique in the database
        while (Calendar::where('event_reminder_id', $uniqueId)->exists()) {
            $uniqueId = uniqid($prefix);
        }

        return $uniqueId;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $calendar = Calendar::findOrFail($id);
        return view('calendar.view', compact('calendar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $calendar = Calendar::findOrFail($id);
        return view('calendar.edit', compact('calendar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_date' => 'nullable|date',
            'end_time' => 'nullable|date_format:H:i',
            'notes' => 'nullable|string',
            'external_recipients' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);

        $calendar = Calendar::findOrFail($id);
        $calendar->update($validatedData);

		return response()->json(['status' => 'success', 'load' => true, 'message' => 'Event updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calendar = Calendar::findOrFail($id);
        $calendar->delete();

		return response()->json(['status' => 'success', 'load' => true, 'message' => 'Event deleted successfully.']);
    }

    /**
     * Show the form for importing a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showImportForm()
    {
        return view('calendar.import');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        Excel::import(new CalendarImport, $request->file('file'));

		return response()->json(['status' => 'success', 'load' => true, 'message' => 'Events imported successfully.']);
    }

    /**
     * Create the Sync Method.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function syncEvents(Request $request)
    {
        $eventData = $request->all();
        $event = Calendar::updateOrCreate(
            ['event_reminder_id' => $this->generateEventReminderId()],
            $eventData
        );

		return response()->json(['status' => 'success', 'load' => true, 'message' => 'Events sync successfully.']);
    }
}
