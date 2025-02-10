<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>{{ $website_name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        body {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            position: relative;
            -webkit-text-size-adjust: none;
            background-color: #ffffff;
            color: #718096;
            height: 100%;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            width: 100% !important;
        }

        table.wrapper {
            box-sizing: border-box;
            background-color: #edf2f7;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }

        .header {
            padding: 25px 0;
            text-align: center;
        }

        .header a {
            color: #3d4852;
            font-size: 19px;
            font-weight: bold;
            text-decoration: none;
        }

        .body {
            background-color: #edf2f7;
            border-bottom: 1px solid #edf2f7;
            border-top: 1px solid #edf2f7;
            border: hidden !important;
            padding: 0;
            width: 100%;
        }

        .inner-body {
            background-color: #ffffff;
            border-color: #e8e5ef;
            border-radius: 2px;
            border-width: 1px;
            box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015);
            margin: 0 auto;
            padding: 0;
            width: 570px;
        }

        .content-cell {
            max-width: 100vw;
            padding: 32px;
        }

        .content-cell h1 {
            color: #3d4852;
            font-size: 18px;
            font-weight: bold;
            margin-top: 0;
            text-align: left;
        }

        .content-cell p {
            font-size: 16px;
            line-height: 1.5em;
            margin-top: 0;
            text-align: left;
        }

        .subcopy {
            border-top: 1px solid #e8e5ef;
            margin-top: 25px;
            padding-top: 25px;
        }

        .subcopy p {
            font-size: 14px;
            line-height: 1.5em;
            margin-top: 0;
            text-align: left;
        }

        .footer {
            /* padding: 20px; */
            text-align: center;
        }

        .footer p {
            font-size: 12px;
            color: #b0aec5;
            line-height: 1.5em;
            margin-top: 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="header">
                            <a href="{{ config('app.url') }}">{{ $website_name }}</a>
                        </td>
                    </tr>

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0"
                                role="presentation">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell">
                                        <h1>Quote Message Received</h1>
                                        <p>We received a quote message from our website page. Here are the details:
                                        </p>
                                        <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td>
                                                    <strong>Name:</strong> {{ $details['name'] }} <br>
                                                    <strong>Email:</strong> {{ $details['email'] }} <br>
                                                    <strong>Phone:</strong> {{ $details['phone'] }} <br>
                                                    <strong>Company:</strong> {{ $details['company'] }} <br>
                                                    <strong>Address:</strong> {{ $details['address'] }} <br>
                                                    <strong>City:</strong> {{ $details['city'] }} <br>
                                                    <strong>Prefer for contact:</strong>
                                                    {{ $details['prefer_contact'] }} <br>
                                                    <strong>Service:</strong> {{ $service_title }} <br>
                                                    <strong>Message:</strong> <br>
                                                    {{ $details['message'] }}
                                                </td>
                                            </tr>
                                        </table>

                                        <table class="subcopy" width="100%" cellpadding="0" cellspacing="0"
                                            role="presentation">
                                            <tr>
                                                <td>
                                                    <p>This email was generated by the system.<br>{{ $website_name }}</p>
                                                </td>
                                            </tr>
                                        </table>

                                        <p>Thank you for reaching out to us!</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- End of Email Body -->

                    <tr>
                        <td class="footer" align="center">
                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td class="content-cell" align="center">
                                        <p>© {{ date('Y') }} Konstruxio. All rights reserved.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
