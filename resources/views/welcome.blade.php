<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@900&family=Russo+One&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                background-image: url('images/background.jpg');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                color: rgb(255, 255, 255);
                font-family: 'Russo One', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .myButton {
                box-shadow:inset 0px 1px 0px 0px #cf866c;
                background:linear-gradient(to bottom, #d0451b 5%, #bc3315 100%);
                background-color:#CC3333;
                border-radius:3px;
                border:1px solid #942911;
                display:inline-block;
                cursor:pointer;
                color:#ffffff;
                font-family:Arial;
                font-size:21px;
                padding:16px 57px;
                text-decoration:none;
                text-shadow:0px 1px 0px #854629;
            }
            .myButton:hover {
                background:linear-gradient(to bottom, #bc3315 5%, #d0451b 100%);
                background-color:#bc3315;
            }
            .myButton:active {
                position:relative;
                top:1px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content" >
                <div class="title m-b-md">
                    F1 Pickem
                </div>


                    @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="myButton">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="myButton">Login</a>
                        @endif
                    @endauth

                </div>
            </div>
        </div>
    </body>
</html>
