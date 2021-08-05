<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom-css.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- SCRIPT FOR HANDLING AJAX REQUEST -->
    <script>
        const form = document.querySelector('#add-user-form');
        const name = document.querySelector('#name');
        const email = document.querySelector('#email');
        const password = document.querySelector('#password');
        const passwordConfirm = document.querySelector('#password-confirm');
        const level = document.querySelector('#level');
        const addUser = document.querySelector('#addUser');

        let _token = $('meta[name="csrf-token"]').attr('content');

        //FUNCTION TO SEND REQUEST
        async function sendRequest() {
            const data = {
                name: name.value,
                email: email.value,
                password: password.value,
                password_confirmation: passwordConfirm.value,
                level: level.value,
                _token: _token
            };

            const result = await fetch('/add-user', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8',
                    'Accept': 'application/json;charset=UTF-8'
                },
                body: JSON.stringify(data),
            });

            return result.json();
        }

        // FUNCTION TO CREATE ERROR MESSAGE
        function createErrorHTML(message) {
            return `<span class="help-block">
                                <strong>${message}</strong>
                            </span>`;
        }

        addUser.addEventListener('click', async function(event) {
            event.preventDefault();

            const result = await sendRequest();

            if (result.status) {
                // hide modal box
                $('#modelAddUser').modal('hide');

                // add message for add user successfully
                const box = document.querySelector('#messageBoxContainer');
                box.innerHTML = `<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>${result.message}</strong>
                </div>`;

            } else {
                // SHOW ERROR IN MODAL BOX
                $('#modelAddUser').modal('show');

                if (result.errors.email) {
                    email.parentElement.innerHTML += createErrorHTML(result.errors.email);
                }
                if (result.errors.password) {
                    password.parentElement.innerHTML += createErrorHTML(result.errors.password);
                }
                if (result.errors.level) {
                    level.parentElement.innerHTML += createErrorHTML(result.errors.level);
                }
                if (result.errors.name) {
                    name.parentElement.innerHTML += createErrorHTML(result.errors.name);
                }

                console.log(result)
            }
        });
    </script>
</body>

</html>