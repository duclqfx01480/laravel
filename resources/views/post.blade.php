{{-- START: CONTENT OF CHAPTER 6--}}
{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>viewPost</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--    <h1>Viewing post #{{$id}} {{$name}}</h1>--}}

{{--</body>--}}
{{--</html>--}}

{{-- END: CONTENT OF CHAPTER 6--}}

@extends('layouts.app')

@section('content')
    <h1>Post Page</h1>
    <h1>Viewing post {{$id}} {{$name}}</h1>
@endsection {{-- hoặc có thể dùng stop--}}

{{--@section('footer');--}}
{{--<h1>Footer</h1>--}}
{{--@endsection(); --}}{{-- hoặc có thể dùng stop--}}
