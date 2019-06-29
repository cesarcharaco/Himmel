<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    @include('layouts.meta')

    @yield('title')

    @include('layouts.css')
    
    @yield('css')

</head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper">
        @include('layouts.header')
        @include('layouts.sidebar')
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            @yield('content')
            @include('layouts.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>

    
    @include('layouts.scripts')

</body>
</html>