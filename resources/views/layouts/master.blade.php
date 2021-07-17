<!DOCTYPE html>
<html lang="en">

@include('layouts.header')

<body>
    <div class="main-wrapper">

        @include('layouts.sidebar')

        <div class="page-wrapper"> 
            
        @include('layouts.navbar')

    @yield('content')
    @include('layouts.footer')
