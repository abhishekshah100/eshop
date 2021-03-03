<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title','LED eSHOP')</title>
    <meta name="keywords" content="@yield('meta_keywords','some default keywords')">
    <meta name="description" content="@yield('meta_description','default description')">
    <link rel="canonical" href="{{url()->current()}}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/img/favicon.ico') }}" />
    <!--********************************** 
        all css files 
    *************************************-->
    <!--*************************************************** 
       fontawesome,bootstrap,plugins and main style css
     ***************************************************-->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/ionicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/simple-line-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.min.css') }}" />
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">
    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!--**************************** 
         Minified  css 
    ****************************-->
    <!--*********************************************** 
       vendor min css,plugins min css,style min css
     ***********************************************-->
    <!-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/vendor/vendor.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.min.css') }}" /> -->
    <style>@stack('frontendcss')</style>
</head>
<body>