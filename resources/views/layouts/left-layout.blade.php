<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <title>@yield('title')</title>
</head>
<body>

@include('includes.header')

<div class="container-fluid">
    <div class="row my-3">
        <div class="col-3">

            @yield('sidebar')

        </div>
        <div class="col">

            @yield('content')

        </div>
    </div>

</div>
</body>
</html>