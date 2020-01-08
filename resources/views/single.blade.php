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

        .half-height {
            margin-top: 100px;
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

        .table-title {
            font-weight: bold;
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

    @foreach($paste as $one)
    <div class="content">
        <div class="title m-b-md">{{$one->title}}</div>

        <table>
            <tr>
                <td class="table-title">RAW Paste Data</td>
                <td>{{$one->paste}}</td>
            </tr>
            <tr>
                <td class="table-title">Lifetime</td>
                <td>
                    @php
                        switch ($one->expiration_time){
                            case -1:
                                echo "Never";
                                break;
                            case 0.17:
                                echo "10 Min";
                                break;
                            case 1:
                                echo "1 Hour";
                                break;
                            case 3:
                                echo "3 Hours";
                                break;
                            case 24:
                                echo "1 Day";
                                break;
                            case 168:
                                echo "1 Week";
                                break;
                            case 730:
                                echo "1 Month";
                                break;
                    }
                    @endphp
                </td>
            </tr>
            <tr>
                <td class="table-title">Access</td>
                <td>
                    @php
                        switch ($one->access){
                            case 0:
                                echo "Unlisted";
                                break;
                            case 1:
                                echo "Public";
                                break;
                            }
                    @endphp

                </td>
            </tr>
            <tr>
                <td class="table-title">Created</td>
                <td>{{$one->created_at}}</td>
            </tr>
        </table>
        @endforeach

        <div class="links half-height">
            <a href="/">Home</a>
            <a href="{{route('pasteFilling')}}">Add paste</a>
            <a href="{{route('pasteCreate')}}">Create random paste</a>
            <a href="{{route('pasteList')}}">List of pastes</a>
        </div>

    </div>

        <table class="right">
            @foreach($tenPastes as $one)
                <tr>
                    <td>
                        <a href="{{$one->hash}}">{{$one->title}}</a>
                    </td>
                </tr>
            @endforeach
        </table>
</div>
</body>
</html>
