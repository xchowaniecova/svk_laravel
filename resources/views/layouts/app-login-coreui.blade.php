<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui@3.4.0/dist/css/coreui.min.css" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/free.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/brand.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/flag.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.2/css/perfect-scrollbar.css" integrity="sha512-2xznCEl5y5T5huJ2hCmwhvVtIGVF1j/aNUEJwi/BzpWPKEzsZPGpwnP1JrIMmjPpQaVicWOYVu8QvAIg9hwv9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body class="c-app flex-row align-items-center">
    
    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js" integrity="sha512-yUNtg0k40IvRQNR20bJ4oH6QeQ/mgs9Lsa6V+3qxTj58u2r+JiAYOhOW0o+ijuMmqCtCEg7LZRA+T4t84/ayVA==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@coreui/coreui@3.4.0/dist/js/coreui.min.js"></script>
    
    
</body>
</html>