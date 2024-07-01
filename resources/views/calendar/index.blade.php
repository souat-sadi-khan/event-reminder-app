@extends('layouts.app')

@section('content')

<div class="calendar-wrapper">
    <div class="calendar-sidebar">
        <div class="calendar-sidebar-header">
            <button type="button" class="btn btn-icon content_management btn-sm btn-outline-orange btn-block" data-url="{{ route('calendars.create') }}">
                <i data-feather="plus" class="mr-2"></i> 
                Create New Event
            </button>
        </div>
    
        <div id="calendarSidebarBody" class="calendar-sidebar-body">
            <div class="calendar-inline">
                <div id="calendarInline"></div>
            </div>

            <div class="pd-20 mg-b-20">
                <label class="tx-uppercase tx-spacing-1 text-success"><strong>Completed Events</strong></label>
                <div class="schedule-group">
                    @if (count($recentCompletedCalendars))
                        <div class="scrollbar">
                            @foreach ($recentCompletedCalendars as $completed)
                                <a href="javascript:;" data-url="{{ route('calendars.show', $completed->id) }}" class="schedule-item bd-l bd-2 bd-success content_management">
                                    <h6>{{ $completed->title }}</h6>
                                    <span>{{ $completed->start_date .' '. $completed->start_time }} - {{ $completed->end_date . ' ' . $completed->end_time }}</span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <ul class="list-group">
                            <li class="list-group-item text-center">
                                <img src="{{ asset('images/noEvents.svg') }}" alt="No event" style="width: 200px;"><br>
                                <b>Nothing to show.</b>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
            
            <div class="pd-20 mg-b-20">
                <label class="tx-uppercase tx-spacing-1 text-danger"><strong>Overdue Events</strong></label>
                <div class="schedule-group">
                    @if (count($recentOverdueCalendars))
                        <div class="scrollbar">
                            @foreach ($recentOverdueCalendars as $overdue)
                                <a href="javascript:;" data-url="{{ route('calendars.show', $overdue->id) }}" class="schedule-item content_management bd-l bd-2 bd-danger">
                                    <h6>{{ $overdue->title }}</h6>
                                    <span>{{ $overdue->start_date .' '. $overdue->start_time }} - {{ $overdue->end_date . ' ' . $overdue->end_time }}</span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <ul class="list-group">
                            <li class="list-group-item text-center">
                                <img src="{{ asset('images/noEvents.svg') }}" alt="No event" style="width: 200px;"><br>
                                <b>Nothing to show.</b>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="calendar-content">
        <div id="calendar" class="calendar-content-body"></div>
    </div>
</div>

@endsection