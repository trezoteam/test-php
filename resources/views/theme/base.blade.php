<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>@yield('title') - Quiz</title>
        <!-- Required meta tags -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    </head>
    <body>
        @include('theme.header')
        @include('theme.messages')
        <div class="row" style="margin-top:5px;">
            <div class="col-md-12">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/geral.js')}}"></script>

        @yield('js')
    </body>
</html>