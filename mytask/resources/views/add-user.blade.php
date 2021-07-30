@extends('layouts.app')

@section('content')
<div class="container">
    <h4 style="text-align: center;">ADD USER</h4>

    <form action="/add-user" method="post">
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

</div>
@endsection