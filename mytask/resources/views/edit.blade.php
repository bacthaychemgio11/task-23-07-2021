@extends('layouts.app')

@section('content')
<div class="container">
    <h4 style="text-align: center;">UPDATE INFORMATION</h4>

    <form action="/edit" method="post">
        {{ csrf_field() }}
        <div class="mb-3">
            <input type="hidden" class="form-control" id="id" name="id" value="{{$user->id}}">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name') ? old('name') : $user->name}}" class=" form-control" id="name">

            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" value="{{ old('email') ? old('email') : $user->email}}" class=" form-control" id="email">

            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <input type="number" name="level" min="0" max="5" value="{{ old('level') ? old('level') : $user->level}}" class="form-control" id="level">

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