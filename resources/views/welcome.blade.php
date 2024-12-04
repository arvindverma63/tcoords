<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <link rel="stylesheet" href="{{ asset('css/login-page.css') }}">
</head>

<body>
    @include('partials.navbar')


    <div class="container">
        <div class="box">
            <img src="{{asset('images/logo/logo-removebg-preview.png')}}">
            <a data-mdb-ripple-init class="btn btn-primary" style="background-color: #0082ca;" href="/linkedin/auth"
                role="button"><i class="fab fa-linkedin-in me-2"></i>LinkedIn</a>
        </div>
    </div>


    @include('partials.footer')
    @include('partials.js')

</html>
