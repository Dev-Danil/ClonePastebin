<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
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

        .right {
            text-align: center;
            position: fixed; /* Фиксированное положение */
            right: 10%; /* Расстояние от правого края окна браузера */
            top: 30%;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            Add new Paste
        </div>

        <form method="POST" action="{{route('pasteStore')}}">

            <table>
                <tr>
                    <td>
                        <libel for="name">Paste Name / Title:</libel>
                    </td>
                    <td><input type="text" id="name" name="title"></td>
                </tr>
                <tr>
                    <td>
                        <libel for="paste-text">New Paste</libel>
                    </td>
                    <td><textarea id="paste-text" name="paste"></textarea></td>
                </tr>
                <tr>
                    <td>
                        <libel for="expiration">Paste Expiration:</libel>
                    </td>
                    <td>
                        <select id="expiration" name="expiration_time">
                            <option value="0.16667">10 Min</option>
                            <option value="1">1 Hour</option>
                            <option value="3">3 Hours</option>
                            <option value="24">1 Day</option>
                            <option value="168">1 Week</option>
                            <option value="730">1 Month</option>
                            <option value="-1">Never</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <libel for="access">Paste Exposure:</libel>
                    </td>
                    <td>
                        <select id="access" name="access">
                            <option value="1">Public</option>
                            <option value="0">Unlisted</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit">+Paste</button>
                    </td>
                </tr>


            </table>
            {{ csrf_field() }}
        </form>

        <table class="right">
            @foreach($tenPastes as $one)
                <tr>
                    <td>
                        <a href="single/{{$one->hash}}">{{$one->title}}</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="links">
            <a href="/">Home</a>
            <a href="{{route('pasteCreate')}}">Create random paste</a>
            <a href="{{route('pasteList')}}">List of pastes</a>
        </div>
    </div>
</div>
</body>
</html>
