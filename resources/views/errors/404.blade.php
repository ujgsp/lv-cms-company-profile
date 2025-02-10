<!doctype html>
<html>
<style type="text/css">
    @charset "UTF-8";
    /* CSS Document */

    body {
        background: #fff;
        padding: 0;
        margin: 0;
        font-family: Helvetica, Arial, sans-serif;
    }

    .container {
        background-color: #fff;
        margin: 0 auto;
        text-align: center;
        padding-top: 50px;
    }

    h3 {
        font-size: 16px;
        color: #3498db;
        font-weight: bold;
        text-align: center;
        line-height: 130%;
    }

    @media screen and (max-width: 500px) {
        img {
            width: 70%;
        }

        .container {
            padding: 70px 10px 10px 10px;
        }

        h3 {
            font-size: 14px;
        }
    }

    /* CSS */
    .button-2 {
        background-color: rgba(51, 51, 51, 0.05);
        border-radius: 8px;
        border-width: 0;
        color: #333333;
        cursor: pointer;
        display: inline-block;
        font-family: "Haas Grot Text R Web", "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        font-weight: 500;
        line-height: 20px;
        list-style: none;
        margin: 0;
        padding: 10px 12px;
        text-align: center;
        transition: all 200ms;
        vertical-align: baseline;
        white-space: nowrap;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    a:link {
        text-decoration: none;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const redirectBtn = document.getElementById("redirectBtn");
        const titleBtn = document.getElementById("titleBtn");
        const currentURL = window.location.href;

        if (currentURL.includes('/dashboard')) {
            redirectBtn.href = '/dashboard';
            titleBtn.innerHTML = 'Dashboard';
        } else {
            redirectBtn.href = '/';
        }
    });
</script>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Error 404 - Page Not Found!</title>
    <link href="./assets/images/favicon.png" rel="shortcut icon" type="image/x-icon" />
</head>

<body>
    <div class="container">
        <img class="ops" src="{{ asset('static/images/404.svg') }}" />
        <br />
        <h3>The page you requested was not found.</h3>
        <br />
        <a id="redirectBtn" class="button-2" href="{{ url('/') }}">Back to <span id="titleBtn">Home Page</span></a>
    </div>
</body>

</html>

