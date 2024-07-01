<header class="navbar navbar-header navbar-header-fixed">
    <a href="javascript:;" id="mainMenuOpen" class="burger-menu">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-brand">
        <a href="javascript:;" class="df-logo">
            <img src="{{ get_option('logo') ? asset('storage/logo/' . get_option('logo')) : asset('images/logo.png') }}" style="width:150px;" alt="System Logo">
        </a>
    </div>
    <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
            <a href="javascript:;" class="df-logo">
                <img src="{{ get_option('logo') ? asset('storage/logo/' . get_option('logo')) : asset('images/logo.png') }}" style="width:150px;" alt="System Logo">
            </a>
            <a id="mainMenuClose" href="javascript:;">
                <i data-feather="x"></i>
            </a>
        </div>
        
        <ul class="nav navbar-menu">
            <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li>
            
            <li class="nav-item">
                <a href="javascript:;" class="nav-link content_management" data-url="{{ route('system-configuration') }}">
                    System Configuration
                </a>
            </li>

            <li class="nav-item">
                <a href="javascript:;" class="nav-link content_management" data-url="{{ route('calendars.import') }}">
                    Import CSV
                </a>
            </li>
            
            <li class="nav-item">
                <a href="javascript:;" class="nav-link content_management" data-url="{{ route('calendars.create') }}">
                    New Event
                </a>
            </li>
        </ul>
    </div>

    <div class="navbar-right">

        
    </div>
</header>