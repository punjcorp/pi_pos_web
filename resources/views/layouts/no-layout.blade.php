<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <title>@yield('title')</title>
</head>
<body>


<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-7">

            @yield('content')

        </div>
    </div>
</div>

</body>
</html>