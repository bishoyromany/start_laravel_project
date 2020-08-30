<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/all.min.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css"> --}}
</head>
<body>
    <?php $user = Auth::user(); ?>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="page-container">
            <div class="page-wrapper chiller-theme chiller-theme">
                <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </a>
                <nav id="sidebar" class="sidebar-wrapper">
                    <div class="sidebar-content">
                    <div class="sidebar-brand">
                        <a href="{{route('home')}}">Admin CPanel</a>
                        <div id="close-sidebar">
                            <i class="fa fa-times"></i>
                        </div>
                    </div>
                    <div class="sidebar-header">
                        <div class="user-pic">
                        <img class="img-responsive img-rounded" src="{{asset('images/admin.svg')}}"
                            alt="User picture">
                        </div>
                        <div class="user-info">
                        <span class="user-name">
                            <strong>{{$user->name}}</strong>
                        </span>
                        <span class="user-role">Administrator</span>
                        <span class="user-status">
                            <i class="fa fa-circle" color="green"></i>
                            <span>Online</span>
                        </span>
                        </div>
                    </div>

                    <!-- sidebar-header  -->
                    <div class="sidebar-search">
                        <div>
                        <div class="input-group">
                            <input type="text" class="form-control search-menu" placeholder="Search...">
                            <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </span>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- sidebar-menu  -->
                    <div class="sidebar-menu">
                        <ul>

                            <li class="header-menu">
                                <span>Quick Links</span>
                            </li>

                            <li>
                                <a href="{{route('welcome')}}">
                                    <i class="fas fa-home"></i>
                                    <span>Welcome {{auth()->user()->name ?? 'Anonymous'}}</span>
                                </a>
                            </li>

                            {{-- Gateway Statics --}}
                            <li class="sidebar-dropdown"> 
                                <a href="#">
                                    <i class="fa fa-cog"></i> 
                                    <span>System Configurations</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>

                                        <li>
                                            <a href="{{route('configSections')}}"> 
                                                <i class="fa fa-desktop"></i>
                                                Configs Sections
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a href="{{route('configs.sections')}}"> 
                                                <i class="fa fa-cog"></i> 
                                                Configs
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('welcome')}}"> 
                                                <i class="fas fa-chart-bar"></i>
                                                Statics
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('configs.sections')}}"> 
                                                <i class="fas fa-upload"></i>
                                                Update
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="{{route('users')}}">
                                    <i class="fa fa-users"></i>
                                    <span>Manage Users</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('gateways')}}">
                                    <i class="fa fa-magic"></i>
                                    <span>Manage Gateway Provider</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('operators')}}">
                                    <i class="fa fa-edit"></i>
                                    <span>Manage Operators</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('links')}}">
                                    <i class="fa fa-plug"></i>
                                    <span>Manage Gateways</span>
                                </a>
                            </li>


                            {{-- Gateway Statics --}}
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fa fa-info-circle"></i> 
                                    <span>Reports</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        {{-- 
                                        <li>
                                            <a href="{{route('portReports')}}"> 
                                                <i class="fa fa-dollar-sign"></i>
                                                Balance/Minutes Reports
                                            </a>
                                        </li> --}}

                                        <li>
                                            <a href="{{route('portReports')}}"> 
                                                <i class="fa fa-sim-card"></i>
                                                Port Reports
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a href="{{route('SystemReports')}}"> 
                                                <i class="fa fa-desktop"></i> 
                                                System Reports
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>


                            {{-- Gateway Statics --}}
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fa fa-chart-bar"></i>
                                    <span>Gateway Statics</span>
                                    <span class="badge badge-pill badge-warning">New</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li>
                                            <a href="{{route('gatewaysSettings')}}"> 
                                                <i class="fa fa-cog"></i>
                                                Gateway Settings
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('RunInformations')}}"> 
                                                <i class="fa fa-book"></i>
                                                Run Information
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('MobileInformations')}}"> 
                                                <i class="fa fa-book"></i> 
                                                Mobile Information
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('SIPInformations')}}"> 
                                                <i class="fa fa-book"></i> 
                                                SIP Information
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('SIPInformationGroups')}}"> 
                                                <i class="fa fa-book"></i> 
                                                SIP Information Groups
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('SystemReports')}}"> 
                                                <i class="fa fa-info-circle"></i> 
                                                Reports
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            {{-- Cards Manager --}}
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fa fa-tags"></i>
                                    <span>Manage Cards</span>
                                    <span class="badge badge-pill badge-warning">New</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li>
                                            <a href="{{route('purchases')}}"> 
                                                <i class="fa fa-shopping-cart"></i>
                                                Purchases
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('cards')}}"> 
                                                <i class="fa fa-tags"></i> 
                                                Cards
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- SIMs Manager --}}
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fa fa-sim-card"></i>
                                    <span>Manage SIMs</span>
                                    <span class="badge badge-pill badge-warning">New</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li>
                                            <a href="{{route('portReports')}}"> 
                                                <i class="fa fa-info-circle"></i>
                                                Port Reports
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('overviews')}}"> 
                                                <i class="fa fa-share"></i>
                                                Overview
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('charges')}}">
                                                <i class="fa fa-dollar-sign" aria-hidden="true"></i>
                                                <span>Manage Balances</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('numbers')}}"> 
                                                <i class="fa fa-phone"></i>
                                                Numbers
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('packages.minutes')}}"> 
                                                <i class="fa fa-cubes"></i> 
                                                Minutes\Packages
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('minutes')}}"> 
                                                <i class="fa fa-cubes"></i> 
                                                Minutes
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('calls')}}"> 
                                                <i class="fa fa-phone"></i>
                                                Calls
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('events')}}"> 
                                                <i class="fa fa-share"></i>
                                                Events
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('IMEIsChangeHistory')}}"> 
                                                <i class="fa fa-share"></i>
                                                IMEI Change History
                                            </a>
                                        </li>


                                        <li>
                                            <a href="{{route('errors')}}"> 
                                                <i class="fa fa-bug"></i> 
                                                Errors
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('reports')}}"> 
                                                <i class="fa fa-info-circle"></i> 
                                                Reports
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="{{route('codes')}}">
                                    <i class="fas fa-sim-card"></i>
                                    <span>Manage USSD</span>
                                </a>
                            </li>


                            {{-- Recorders Manager --}}
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    {{-- <i class="fa fa-circle"></i> --}}
                                    <span>Realtime Recorders</span>
                                    <span class="badge badge-pill badge-warning">New</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li>
                                            <a href="{{route('alerts')}}">
                                                <i class="fa fa-circle"></i>
                                                <span>Alerts</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('ajax')}}">
                                                <i class="fa fa-circle"></i>
                                                <span>USSD Recorder</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('monitorsRecords')}}">
                                                <i class="fa fa-circle"></i>
                                                <span>Monitor Recorder</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            

                            {{-- Monitors --}}
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fa fa-desktop"></i>
                                    <span>Monitors</span>
                                    <span class="badge badge-pill badge-warning">New</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li>
                                            <a href="{{route('monitorings')}}">
                                                <i class="fa fa-desktop"></i>
                                                <span>Manage Monitoring</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('MonitoringsSettings')}}">
                                                <i class="fa fa-cog"></i>
                                                <span>Monitors Settigns</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('MonitorStatics')}}">
                                                <i class="fa fa-info-circle"></i>
                                                <span>Monitor Statics</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            {{-- Tasks --}}
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fa fa-tasks"></i>
                                    <span>Tasks/Scripts</span>
                                    <span class="badge badge-pill badge-warning">New</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li>
                                            <a href="{{route('tasks')}}"> 
                                                <i class="fa fa-tasks"></i>
                                                <span>Manage Tasks</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('steps')}}">
                                                <i class="fa fa-puzzle-piece" aria-hidden="true"></i>
                                                <span>Manage Steps</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('scripts')}}">
                                                <i class="fa fa-code"></i>
                                                <span>Manage Scripts</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('tasksErrorsHandlers')}}"> 
                                                <i class="fa fa-bug"></i>
                                                <span>Manage Errors Handlers</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('busyPorts')}}"> 
                                                <i class="fa fa-tasks"></i>
                                                <span>Manage Busy Ports</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- Debug URLS --}}
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fa fa-cog"></i>
                                    <span>Advanced</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li>
                                            <a href="{{route('debugger.active.sessions')}}" target="_blank"> 
                                                <i class="fa fa-tasks"></i>
                                                <span>Active Sessions</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('debugger.fix.db')}}" target="_blank"> 
                                                <i class="fa fa-tasks"></i>
                                                <span>Fix DB</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('debugger.reset.settings')}}" target="_blank"> 
                                                <i class="fa fa-tasks"></i>
                                                <span>Reset System Configs</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('debugger.update.settings')}}" target="_blank"> 
                                                <i class="fa fa-tasks"></i>
                                                <span>Update System Configs</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('debugger.update.settings.push', ['branch' => 'master'])}}" target="_blank"> 
                                                <i class="fa fa-tasks"></i>
                                                <span>Update System + Push</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('monitor.caller.serve')}}" target="_blank">
                                                <i class="fa fa-desktop"></i>
                                                <span>Start Monitor Caller</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('serve.monitoring.new')}}?mid=monitor_id&isTest=1&allowedPorts=false&api=1&pw={{env('MONITOR_PASSWORD')}}&type=tasks" target="_blank">
                                                <i class="fa fa-cog"></i>
                                                <span>Monitor Test URL</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('debugger.download.latest.updates', ['branch' => 'master'])}}" target="_blank">
                                                <i class="fa fa-arrow-down"></i>
                                                <span>Latest Master Updates</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('debugger.download.latest.updates', ['branch' => 'dev'])}}" target="_blank">
                                                <i class="fa fa-arrow-down"></i>
                                                <span>Latest Dev Updates</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('debugger.php.ini')}}" target="_blank">
                                                <i class="fa fa-information"></i>
                                                <span>PHP INI</span>
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>

                    <!-- sidebar-menu  -->
                    </div>
                </nav>

                <main class="page-content">
                    @yield('content')
                    <div class="clearfix"></div>
                </main>


                {{-- <monitoring-serve 
                    :urls="{{json_encode([
                        'serve' => route('serve.monitoring'),
                    ])}}"
                /> --}}

            </div>
        </div>

    </div>

    @if(config('app.env') == 'local')
        <script src="http://localhost:35729/livereload.js"></script>
    @endif
</body>
</html>
