<!doctype html>
<html lang="en">

<head>
    @include('layouts.components.main-header')

    <title>Meal Managenment System</title>
</head>





<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('layouts.components.sidbar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('layouts.components.header')
        <!--end header -->
        <!--start page wrapper -->
        @section('main')
        @show
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2025. All right reserved.</p>
        </footer>
    </div>
    <!--end wrapper-->
    @include('layouts.components.footer')
