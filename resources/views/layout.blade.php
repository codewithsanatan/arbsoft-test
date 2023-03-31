<!DOCTYPE html>
<html>
    <head>
        <title>Laravel - ARB Soft Machine Test</title>
        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <style type="text/css">
            @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);
            body {
                margin: 0;
                font-size: .9rem;
                font-weight: 400;
                line-height: 1.6;
                color: #212529;
                text-align: left;
                background-color: #f5f8fa;
            }
            .navbar-laravel {
                box-shadow: 0 2px 4px rgba(0, 0, 0, .04);
            }
            .navbar-brand,
            .nav-link,
            .my-form,
            .login-form {
                font-family: Raleway, sans-serif;
            }
            .my-form {
                padding-top: 1.5rem;
                padding-bottom: 1.5rem;
            }
            .my-form .row {
                margin-left: 0;
                margin-right: 0;
            }
            .login-form {
                padding-top: 1.5rem;
                padding-bottom: 1.5rem;
            }
            .login-form .row {
                margin-left: 0;
                margin-right: 0;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="/">{{env("APP_NAME")}}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="fixed top-0 right-0 px-6 sm:block" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.user') }}">Register</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{auth()->user()->name ?? "Guest"}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')

        <script>
            $(document).ready(function(){
                $('#c_password').keyup(function() {
                    if($('#c_password').val().length > 3 && $('#c_password').val() != $('#password').val()){
                        $('#c_pass_error').html("Password not matching");
                        $('#signup_btn').attr('disabled', true);
                    }else{
                        $('#signup_btn').attr('disabled', false);
                        $('#c_pass_error').html("");
                    }
                });
            });
        </script>
    </body>
</html>
