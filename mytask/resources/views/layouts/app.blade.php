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
        //FUNCTION TO SEND REQUEST
        async function sendRequest(url, data) {

            const result = await fetch(url, {
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

        // SENDING REQUEST FOR ADD USER
        const form = document.querySelector('#add-user-form');

        form.addEventListener('submit', async function(event) {
            let name = document.querySelector('#name');
            let email = document.querySelector('#email');
            let password = document.querySelector('#password');
            let passwordConfirm = document.querySelector('#password-confirm');
            let level = document.querySelector('#level');

            let _token = $('meta[name="csrf-token"]').attr('content');

            const data = {
                name: name.value,
                email: email.value,
                password: password.value,
                password_confirmation: passwordConfirm.value,
                level: level.value,
                _token: _token
            };

            event.preventDefault();

            const result = await sendRequest('/add-user', data);

            if (result.status) {
                // hide modal box
                $('#modelAddUser').modal('hide');

                // RELOAD PAGE
                location.reload(false);

                // add message for adding user successfully
                const box = document.querySelector('#messageBoxContainer');
                box.innerHTML = `<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>${result.message}</strong>
                </div>`;
            } else {
                // SHOW ERROR IN MODAL BOX
                $('#modelAddUser').modal('show');

                // Kiểm tra lỗi có tồn tại hay không, nếu có thì xóa lôi cũ, để xuất thông báo 
                // Tránh thường hợp xuất nhiều thông báo
                if (email.parentElement.querySelector('.help-block') != null) {
                    email.parentElement.removeChild(email.parentElement.querySelector('.help-block'));
                }
                if (password.parentElement.querySelector('.help-block') != null) {
                    password.parentElement.removeChild(password.parentElement.querySelector('.help-block'));
                }
                if (level.parentElement.querySelector('.help-block') != null) {
                    level.parentElement.removeChild(level.parentElement.querySelector('.help-block'));
                }
                if (name.parentElement.querySelector('.help-block') != null) {
                    name.parentElement.removeChild();
                }

                // Hiện thông báo ra màn hình
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
            }
        });

        // SENDING REQUEST FOR EDIT USER
        const editForm = document.querySelector('#edit-user-form');

        editForm.addEventListener('submit', async function(event) {
            event.preventDefault();

            let name = document.querySelector('#editName');
            let email = document.querySelector('#editEmail');
            let id = document.querySelector('#editID');
            let level = document.querySelector('#editLevel');

            let _token = $('meta[name="csrf-token"]').attr('content');

            const data = {
                name: name.value,
                email: email.value,
                level: level.value,
                id: id.value,
                _token: _token
            };

            const result = await sendRequest('/edit', data);

            if (result.status) {
                // hide modal box
                $('#modelEditUser').modal('hide');

                // RELOAD PAGE
                location.reload(false);

                // add message for edit user successfully
                const box = document.querySelector('#messageBoxContainer');
                box.innerHTML = `<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>${result.message}</strong>
                </div>`;
            } else {
                // SHOW ERROR IN MODAL BOX
                $('#modelEditUser').modal('show');

                // Kiểm tra lỗi có tồn tại hay không, nếu có thì xóa lôi cũ, để xuất thông báo 
                // Tránh thường hợp xuất nhiều thông báo
                if (email.parentElement.querySelector('.help-block') != null) {
                    email.parentElement.removeChild(email.parentElement.querySelector('.help-block'));
                }
                if (level.parentElement.querySelector('.help-block') != null) {
                    level.parentElement.removeChild(level.parentElement.querySelector('.help-block'));
                }
                if (name.parentElement.querySelector('.help-block') != null) {
                    name.parentElement.removeChild();
                }

                // Hiện thông báo ra màn hình
                if (result.errors.email) {
                    email.parentElement.innerHTML += createErrorHTML(result.errors.email);
                    email.value = result.oldData.email;
                }
                if (result.errors.level) {
                    level.parentElement.innerHTML += createErrorHTML(result.errors.level);
                    email.value = result.oldData.email;
                }
                if (result.errors.name) {
                    name.parentElement.innerHTML += createErrorHTML(result.errors.name);
                    email.value = result.oldData.email;
                }
            }
        });

        // SENDING REQUEST FOR DELETE USER
        const deleteUser = document.querySelectorAll('.deleteUser');

        deleteUser.forEach(del => {
            del.addEventListener('click', async function() {
                let id = this.dataset.id;

                let option = confirm('Do you want to delete this user?');

                if (option == true) {
                    let _token = $('meta[name="csrf-token"]').attr('content');

                    const data = {
                        id: id,
                        _token: _token
                    };

                    const result = await sendRequest('/remove', data);

                    if (result.status) {
                        // add message for edit user successfully
                        const box = document.querySelector('#messageBoxContainer');
                        box.innerHTML = `<div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>${result.message}</strong>
                        </div>`;

                        // RELOAD PAGE
                        location.reload(false);
                    } else {
                        // SHOW ERROR IN MODAL BOX
                        console.log('Remove item failed');
                    }
                }
            });
        });
    </script>
</body>

</html>