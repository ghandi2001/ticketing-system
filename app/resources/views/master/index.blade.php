<!DOCTYPE html>
<html lang="fa">

<head>
    @include('master.head')
</head>

<body>

@include('master.preloader')

<div id="main-wrapper">

    @include('master.navigation')

    @include('master.header')

    @include('master.sidebar')

    <div class="content-body">
        <div class="container-fluid">
            @yield('outrow-contents')
            <div class="row">
                @yield('contents')
            </div>
        </div>
    </div>
</div>

@include('master.footer')

@include('master.scripts')
</body>
</html>
