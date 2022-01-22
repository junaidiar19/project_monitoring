<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @method('before-style')
    @include('includes.styles')
    @stack('after-style')

    <title>Project Monitoring</title>
</head>
<body class="body-pd" id="body-pd">
    
    @include('template.header')
    @include('includes.sidebar')

    <div class="container-fluid">
        @yield('content')
    </div>

    @stack('before-scripts')
    @include('includes.scripts')
    @stack('after-scripts')
</body>
</html>