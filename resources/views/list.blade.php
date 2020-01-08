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
            height: 50vh;
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
<h1>Records</h1>
{{--@foreach($pastes as $one)--}}
{{--<h3> {{ $one }}</h3>--}}
{{--@endforeach--}}

<table style="border-spacing: 7px 11px;" class="content">
    <tr style="font-weight: bold">
        <td>ID</td>
        <td>Hash</td>
        <td>Title</td>
        <td>Text of paste</td>
        <td>Expiration time</td>
        <td>Access</td>
        <td>Created_at</td>
        <td>Updated_at</td>
    </tr>
    @foreach($pastes as $one)
        <tr>
            <td>{{$one->id}}</td>
            <td>{{$one->hash}}</td>
            <td>{{$one->title}}</td>
            <td>{{$one->paste}}</td>
            <td>{{$one->expiration_time}}</td>
            <td>{{$one->access}}</td>
            <td>{{$one->created_at}}</td>
            <td>{{$one->updated_at}}</td>
        </tr>
    @endforeach
</table>


<table class="right">
    @foreach($tenPastes as $one)
        <tr>
            <td>
                <a href="single/{{$one->hash}}">{{$one->title}}</a>
            </td>
        </tr>
    @endforeach
</table>

<div class="flex-center position-ref full-height">
    <div class="links">
        <a href="/">Home</a>
        <a href="{{route('pasteFilling')}}">Add paste</a>
        <a href="{{route('pasteCreate')}}">Create random paste</a>
    </div>
</div>
</body>
</html>


