@extends('layouts.app')

@section('content')
<div class="container">
    <h4 style="text-align: center;">ADD USER</h4>

    <form action="/add-user" id='add-user-form' method="post">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class=" form-control" id="name" value="{{ old('name') }}" required>

            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class=" form-control" id="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class=" form-control" value="{{ old('password') }}" minlength="6" id="password" required>

            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="mb-3">
            <label for="password-confirm" class="form-label">Confirm Password</label>

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <input type="number" name="level" min="0" max="5" value="5" class="form-control" id="level" required>

            @if ($errors->has('level'))
            <span class="help-block">
                <strong>{{ $errors->first('level') }}</strong>
            </span>
            @endif
        </div>

        <button style="margin-top: 10px;" type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        const form = document.querySelector('#add-user-form');
        const name = document.querySelector('#name');
        const email = document.querySelector('#email');
        const password = document.querySelector('#password');
        const level = document.querySelector('#level');

        function sendRequest() {
            const data = {
                name: name.value,
                email: email.value,
                password: password.value,
                level: level.value
            };

            fetch('/add-user', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8',
                        'Accept': 'application/json;charset=UTF-8'
                    },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            sendRequest();
        });
    </script>
</div>
@endsection

<!-- 04/08/2021 -->
<!-- REDESIGN BLADE FILE FOR USING MODAL BOX FORM -->
<!-- @extends('layouts.app')
@section('modal-add-user')
<h1>ABCASASA</h1>

@endsection -->