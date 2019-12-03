<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Poll')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="/css/app.css" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    @yield('title') 
                </div>
                
                <div class="">
                    @yield('content')
                </div>

                <!--
                <div class="links">
                    <a href="/answer/">Answer</a>
                    <a href="{{ url('/') }}">results</a>
                </div>
                // -->
            </div>
        </div>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
