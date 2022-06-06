<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui@3.4.0/dist/css/coreui.min.css" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/free.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">    
     
    <title>{{ config('app.name', 'ŠVK') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

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
    
</body>
</html>