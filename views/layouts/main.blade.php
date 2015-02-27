<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@section('title')</title>

    @include('partials.header')

</head>

<body>

<div class="container" >

@include('partials.navigation')

@include('partials.notifications')

@section('content')
@show

@include('partials.footer')

</div>

@section('scripts')
@show
</body>
</html>
