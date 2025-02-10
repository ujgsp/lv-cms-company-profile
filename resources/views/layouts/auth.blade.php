<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('static-admin/img/avatars/favicon-coderelit-white.png') }}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

    <title>{{ config('app.name') }} - @yield('title')</title>

    <link href="{{ asset('static-admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('static-admin/css/custom.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <img src="{{ asset('static-admin/img/avatars/logo-relitdev.svg') }}"
                                width="200" class="pb-2">
                            <h1 class="h2">Administration Panel</h1>
                            <p class="lead">
                                Konstruxio
                                <span class="badge badge-sm bg-success">1.0</span>
                            </p>
                        </div>

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('static-admin/js/app.js') }}"></script>

</body>

</html>
