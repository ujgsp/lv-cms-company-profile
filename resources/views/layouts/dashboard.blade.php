<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" href="{{ asset('static-admin/img/avatars/favicon-coderelit-white.png') }}" type="image/png">

    <title>@yield('title') — {{ env('APP_NAME') }} Administration</title>

    <link href="{{ asset('static-admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('static-admin/css/custom.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    @stack('css')
</head>

<body>
    <div class="wrapper">
        @include('layouts._dashboard.sidebar')

        <div class="main">
            @include('layouts._dashboard.navbar')



            <main class="content">
                <div class="container-fluid p-0">

                    {{-- <h1 class="h3 mb-3"></h1> --}}
                    <h1 class="h3">
                        <span class="ml-2">@yield('title')</span>
                    </h1>
                    <span class="mb-3">@yield('description')</span>

                    @yield('content')

                </div>
            </main>

            @include('layouts._dashboard.footer')
        </div>
    </div>

    <script src="{{ asset('static-admin/js/app.js') }}"></script>

    <!-- jQuery -->
    <script src="{{ asset('static-admin/jquery/jquery.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('static-admin/js/custom.js') }}"></script>

    @stack('js')

</body>

</html>
