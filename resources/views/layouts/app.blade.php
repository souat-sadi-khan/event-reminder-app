<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
	<meta name="referrer" content="origin">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="canonical" href="{{ url()->current() }}" />
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_option('favicon') ? asset('storage/logo/' . get_option('favicon')) : asset('images/favicon.png') }}">
    
    <title>{{ get_option('site_title') ? get_option('site_title') : 'Event Management App' }}</title>

	<meta property="og:image:width" content="200">
	<meta property="og:image:height" content="200">
	<meta property="og:site_name" content="{{ get_option('site_name') ? get_option('site_name') : 'TechZu' }}">

    @if (get_option('meta_title'))
    <meta name="title" content="{{ get_option('meta_title') }}">
    @endif
    <meta name="author" content="{{ get_option('site_name') }} : {{ request()->url() }} : {{ get_option('email_address') }}">

    @if (get_option('meta_keyword'))
    <meta name="keywords" content="{{ get_option('meta_keyword') }}" />
    @endif

    @if (get_option('meta_description'))
    <meta name="description" content="{{ get_option('meta_description') }}">	
    @endif
	
	<!-- For Open Graph -->
	<meta property="og:url" content="{{ request()->url() }}">	
	<meta property="og:type" content="app">

    @if (get_option('meta_title'))
    <meta property="og:title" content="{{ get_option('meta_title') }}">	
    @endif
    @if (get_option('meta_descript'))
    <meta property="og:description" content="{{ get_option('meta_descript') }}">	
    @endif
	<meta property="og:image" content="{{ asset('images/logo.png') }}">	
	
	<!-- For Twitter -->
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:creator" content="{{ get_option('site_name') }}" /> 
    <meta name="twitter:site" content="{{ request()->url() }}" />		
	<meta name="twitter:image" content="{{ asset('images/logo.png') }}">
    @if (get_option('meta_title'))
    <meta name="twitter:title" content="{{ get_option('meta_title') }}" />
    @endif

    @if (get_option('meta_description'))
    <meta name="twitter:description" content="{{ get_option('meta_description') }}" />	
    @endif

    <!-- Requreid CSS -->
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('calendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('css/date.css') }}">
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('css_scripts')
</head>

<body class="app-calendar">
    <div class="wrapper">

        @include('includes.navbar')

        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <div class="modal calendar-modal-event fade effect-scale" id="modalCalendarEvent" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="event-title"></h6>
                    <nav class="nav nav-modal-event">
                        <a href="#" class="nav-link event-edit"><i data-feather="external-link"></i></a>
                        <a href="javascript:;" id="delete_item" class="nav-link event-delete"><i data-feather="trash-2"></i></a>
                        <a href="javascript:;" class="nav-link" data-dismiss="modal"><i data-feather="x"></i></a>
                    </nav>
                </div>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-sm-6">
                            <label class="tx-uppercase tx-sans tx-11 tx-medium tx-spacing-1 tx-color-03">Start Date</label>
                            <p class="event-start-date"></p>
                        </div>
                        <div class="col-sm-6">
                            <label class="tx-uppercase tx-sans tx-11 tx-medium tx-spacing-1 tx-color-03">End Date</label>
                            <p class="event-end-date"></p>
                        </div>
                    </div>

                    <label class="tx-uppercase tx-sans tx-15 tx-medium tx-spacing-1 tx-color-03">Event ID: <strong class="event-case tx-gray-900"></strong></label>  <br>
                    <label class="tx-sans tx-15 tx-medium tx-spacing-1 tx-color-03">Exteral recipients: <br> <strong class="event-recipients tx-gray-900"></strong></label>  <br> 

                    <label class="tx-uppercase tx-sans tx-11 tx-medium tx-spacing-1 tx-color-03">Description</label>
                    <p class="event-desc tx-gray-900 mg-b-40"></p>

                    <a href="" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal_remote" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="remote-modal-content">
                    
                </div>
			</div>
		</div>
	</div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('calendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/date.js') }}"></script>
    <script src="{{ asset('js/parsley.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        $(function() {

            let overdueEvents = @json($overdueEvents);
            let overdueEventsJson = JSON.parse(overdueEvents);

            let completedEvents = @json($completedEvents);
            let completedEventsJson = JSON.parse(completedEvents);

            let thisWeekEvents = @json($thisWeekEvents);
            let thisWeekEventsJson = JSON.parse(thisWeekEvents);

            let upcomingEvents = @json($upcomingEvents);
            let upcomingEventsJson = JSON.parse(upcomingEvents);

            let curYear = moment().format('YYYY');
            let curMonth = moment().format('MM');
            let upcomingCalendarEvents = {
                id: 1,
                backgroundColor: '#c3edd5',
                borderColor: '#10b759',
                events: upcomingEventsJson
            };

            let overdueCalendarEvents = {
                id: 1,
                backgroundColor: '#fcbfdc',
                borderColor: '#f10075',
                events: overdueEventsJson
            };

            let completedCalednarEvents = {
                id: 5,
                backgroundColor: '#dedafe',
                borderColor: '#5b47fb',
                events: completedEventsJson
            };

            let thisWeekCalednarEvents = {
                id: 5,
                backgroundColor: '#FA7070',
                borderColor: '#FA7070',
                events: thisWeekEventsJson
            };
            
            $('[data-toggle="tooltip"]').tooltip()
            $('#calendarInline').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                beforeShowDay: function(date) {
                    var day = date.getDate();
                    return [true, (day < 10 ? 'zero' : '')];
                },
                onSelect: function (date) {
                    curr_date = date.split("/");
                    main_day = curr_date[1];
                    main_month = curr_date[0];
                    main_year = curr_date[2];
                    date = main_year + '-' + main_month + '-' + main_day ;
                    $('#calendar').fullCalendar('gotoDate',date);  
                    $('#calendar').fullCalendar('changeView','agendaDay');  
                }
            });

            $('#calendar').fullCalendar({
                height: 'parent',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'agendaDay,agendaWeek,month,listWeek'
                },
                navLinks: true,
                selectable: true,
                selectLongPressDelay: 100,
                editable: true,
                nowIndicator: true,
                initialView: 'agendaDay',
                timeFormat: 'H(:mm)',
                views: {
                    agenda: {
                        columnHeaderHtml: function(mom) {
                        return '<span>' + mom.format('ddd') + '</span>' +
                                '<span>' + mom.format('DD') + '</span>';
                        }
                    },
                    day: { columnHeader: true },
                    listMonth: {
                        listDayFormat: 'ddd DD',
                        listDayAltFormat: true
                    },
                    listWeek: {
                        listDayFormat: 'ddd DD',
                        listDayAltFormat: false
                    },
                    agendaThreeDay: {
                        type: 'agenda',
                        duration: { days: 3 },
                        titleFormat: 'MMMM YYYY'
                    }
                },
                eventSources: [overdueCalendarEvents, upcomingCalendarEvents, completedEvents, thisWeekEvents],
                eventAfterAllRender: function(view) {
                    if(view.name === 'listMonth' || view.name === 'listWeek') {
                        var dates = view.el.find('.fc-list-heading-main');
                        dates.each(function(){
                        var text = $(this).text().split(' ');
                        var now = moment().format('DD');

                        $(this).html(text[0]+'<span>'+text[1]+'</span>');
                            if(now === text[1]) { $(this).addClass('now'); }
                        });
                    }
                },
                eventRender: function(event, element) {
                    if(event.description) {
                        element.find('.fc-list-item-title').append('<span class="fc-desc">' + event.description + '</span>');
                        element.find('.fc-content').append('<span class="fc-desc">' + event.description + '</span>');
                    }
                    var eBorderColor = (event.source.borderColor)? event.source.borderColor : event.borderColor;
                    element.find('.fc-list-item-time').css({
                        color: eBorderColor,
                        borderColor: eBorderColor
                    });

                    element.find('.fc-list-item-title').css({
                        borderColor: eBorderColor
                    });

                    element.css('borderLeftColor', eBorderColor);
                },
            });

            var calendar = $('#calendar').fullCalendar('getCalendar');

            // change view to week when in tablet
            if(window.matchMedia('(min-width: 576px)').matches) {
                calendar.changeView('agendaWeek');
            }

            // change view to month when in desktop
            if(window.matchMedia('(min-width: 992px)').matches) {
                calendar.changeView('month');
            }

            // change view based in viewport width when resize is detected
            calendar.option('windowResize', function(view) {
                if(view.name === 'listWeek') {
                if(window.matchMedia('(min-width: 992px)').matches) {
                    calendar.changeView('month');
                } else {
                    calendar.changeView('listWeek');
                }
                }
            });

            // Display calendar event modal
            calendar.on('eventClick', function(calEvent, jsEvent, view){

            var modal = $('#modalCalendarEvent');

            modal.modal('show');
            modal.find('.event-title').text(calEvent.title);

            if(calEvent.id) {
                modal.find('.event-delete').attr('data-url', '/calendars/' + calEvent.id);
            } else {
                modal.find('.event-delete').text('');
            }
            
            if(calEvent.id) {
                modal.find('.event-edit').attr('data-id', calEvent.id);
            } else {
                modal.find('.event-edit').text('');
            }
            
            if(calEvent.description) {
                modal.find('.event-desc').text(calEvent.description);
                modal.find('.event-desc').prev().removeClass('d-none');
            } else {
                modal.find('.event-desc').text('');
                modal.find('.event-desc').prev().addClass('d-none');
            }
            
            if(calEvent.event_reminder_id) {
                modal.find('.event-case').text(calEvent.event_reminder_id);
                modal.find('.event-case').prev().removeClass('d-none');
            } else {
                modal.find('.event-case').text('');
                modal.find('.event-case').prev().addClass('d-none');
            }
            
            if(calEvent.external_recipients) {
                modal.find('.event-recipients').text(calEvent.external_recipients);
                modal.find('.event-recipients').prev().removeClass('d-none');
            } else {
                modal.find('.event-recipients').text('');
                modal.find('.event-recipients').prev().addClass('d-none');
            }

            modal.find('.event-start-date').text(moment(calEvent.start).format('LLL'));
            modal.find('.event-end-date').text(moment(calEvent.end).format('LLL'));

            //styling
            modal.find('.modal-header').css('backgroundColor', (calEvent.source.borderColor)? calEvent.source.borderColor : calEvent.borderColor);

            $('#calendarSidebarShow').on('click', function(e){
                e.preventDefault()
                $('body').toggleClass('calendar-sidebar-show');

                $(this).addClass('d-none');
                $('#mainMenuOpen').removeClass('d-none');
            })

            $(document).on('click touchstart', function(e){
                e.stopPropagation();

                // closing of sidebar menu when clicking outside of it
                if(!$(e.target).closest('.burger-menu').length) {
                    var sb = $(e.target).closest('.calendar-sidebar').length;
                    if(!sb) {
                    $('body').removeClass('calendar-sidebar-show');

                    $('#mainMenuOpen').addClass('d-none');
                    $('#calendarSidebarShow').removeClass('d-none');
                    }
                }
            });
        });

        // display current date
        var dateNow = calendar.getDate();
        calendar.option('select', function(startDate, endDate){
            $('#modal_remote').modal('toggle');
            var start_date = startDate.format('YYYY-MM-DD');
            var end_date = startDate.format('YYYY-MM-DD');
            $.ajax({
                type: "GET",
                url: '/calendars/create',
                data: {start_date:start_date, end_date:end_date},
                beforeSend: function () {
                    $('.remote-modal-content').html('<div class="modal-body text-center"><img style="width:250px;" src="images/loader.gif"></div>')
                },
                success: function(html){
                    $('.remote-modal-content').html(html);

                    $('.date').datetimepicker({
                        timepicker:false,
                        format:'Y-m-d',
                        formatDate:'Y-m-d',
                        scrollMonth : false
                    });
                    $('.tags').tagsinput();

                    $('.time').datetimepicker({
                        datepicker:false,
                        format:'H:i',
                        step:15
                    });
                    _modalFormValidation();
                }
            });
        });

        $('.select2-modal').select2({
            minimumResultsForSearch: Infinity,
            dropdownCssClass: 'select2-dropdown-modal',
        });
    })

    </script>

    @if (!get_option('site_name')) 

        <script>
            $.ajax({
                url: '/system-configuration',
                type: 'Get',
                dataType: 'html',
                beforeSend: function () {
                    $('#modal_remote').modal('toggle');
                    $('.remote-modal-content').html('<div class="modal-body text-center"><img style="width:250px;" src="images/loader.gif"></div>')
                }
            })
            .done(function (data) {
                $('.remote-modal-content').html(data).fadeIn();

                $('.select').select2({
                    width:'100%',
                    dropdownParent: $("#modal_remote")
                });

                _modalFormValidation();
            })
            .fail(function (data) {
                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                $('#modal-loader').hide();
            });
            
        </script>
        
    @endif
    @stack('js_scripts')
</body>

</html>
