@extends('layouts.app')

@section('content')
<div class="container">
    <h4 style="text-align: center;">ADD USER</h4>

    <form action="/add-user" method="post">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class=" form-control" id="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class=" form-control" id="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class=" form-control" minlength="6" id="password" required>
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <input type="number" name="level" min="0" max="5" value="0" class="form-control" id="level" required>
        </div>

        <button style="margin-top: 10px;" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection