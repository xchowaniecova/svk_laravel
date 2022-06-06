<!doctype html>
<html lang="en">

<head>
    
    <title>{{ config('app.name', 'ŠVK') }}</title>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui@3.4.0/dist/css/coreui.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/free.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="msapplication-TileImage" content="{{asset('favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#000000">

    {{-- Sortable --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>

    {{-- Pri sortable --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

    {{-- Textarea pre CMS --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

    {{-- Datatable --}}
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        .card-box {
            position: relative;
            /* color: #fff; */
            padding: 20px 10px 20px;
            margin: 1% 10%;
            text-align: center;
        } 
        .card-box1 {
            position: relative;
            /* color: #fff; */
            padding: 20px 10px 20px;
            margin: 1% 30%;
            text-align: center;
        } 
        .card-box .inner {
            padding: 5px 10px 0 10px;
        }
        .bg-blue {
            /* background-color: #74b6c0; */
            background-color: #c9d6e6;
        }
        .bg-green {
            background-color: #bfe9b5;
        }
        .bg-yellow {
            background-color: #e5e6c9;
        }
        .bg-navbar {
            /* background-color: #264653; */
            background-color: #4b6187;
        }
        .bg-second-navbar {
            background-color: #63A7C3;
        }
        .text-navbar {
            /* color: #264653; */
            color: #334564;
            font-weight: bold;
        }
    </style> 

</head>

<body class="app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <!-- Sidebar content here -->
        @include('_sidebar')
    </div>
    
    <div class="c-wrapper">
        <header>
            @include('_header')
        </header>
        
        <div class="c-body">
            <main class="c-main">

                @if (Session::has('success'))
                <div class="alert alert-success" role="alert">{!! Session::get('success') !!}</div>
                @endif

                @if (Session::has('failure'))
                <div class="alert alert-danger" role="alert">{!! Session::get('failure') !!}</div>
                @endif

                <!-- Main content here -->
                @yield('content')
            </main>
        </div>        
    </div>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js" integrity="sha512-yUNtg0k40IvRQNR20bJ4oH6QeQ/mgs9Lsa6V+3qxTj58u2r+JiAYOhOW0o+ijuMmqCtCEg7LZRA+T4t84/ayVA==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@coreui/coreui@3.4.0/dist/js/coreui.min.js"></script>
    
</body>
</html>