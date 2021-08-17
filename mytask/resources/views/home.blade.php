@extends('layouts.app')

@section('content')
<!-- NAVIGATION MENU -->
<!-- 16/08/2021 -->

<div class="container">
    <div class="col">
        <!-- STATUS MESSAGE WHEN CREATE/UPDATE/DELETE USER -->
        <div id='messageBoxContainer'>
            <!-- @if (Session::has('status-create'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{Session::get('status-create')}}</strong>
        </div>
        @endif -->

            @if (Session::has('status-update'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>{{Session::get('status-update')}}</strong>
            </div>
            @endif

            <!-- @if (Session::has('status-delete'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>{{Session::get('status-delete')}}</strong>
            </div>
            @endif -->
        </div>
    </div>

    <!-- MODAL BOX FOR ADD USER -->
    <div class="modal fade" id="modelAddUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">ADD USER</h4>
                </div>
                <div class="modal-body">
                    <form action="/home" id='add-user-form' method="post">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class=" form-control" id="name" value="{{ old('name') }}" required>

                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" class=" form-control" id="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class=" form-control" value="{{ old('password') }}" minlength="6" id="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirm Password</label>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <input type="number" name="level" min="0" max="5" value="5" class="form-control" id="level" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id='addUser' class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL BOX FOR EDIT USER -->
    <div class="modal fade" id="modelEditUser" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editModalLabel">EDIT USER</h4>
                </div>
                <div class="modal-body">
                    <form action="" id='edit-user-form' method="post">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="editID" name="id" value="">
                        </div>

                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" name="name" value="" class=" form-control" id="editName">
                        </div>

                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="text" name="email" value="" class=" form-control" id="editEmail">
                        </div>

                        <div class="mb-3">
                            <label for="editLevel" class="form-label">Level</label>
                            <input type="number" name="level" min="0" max="5" value="" class="form-control" id="editLevel">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id='editUser' class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="layout"></div>
<!-- REACT 12/08/2021 -->
<script src="{{ mix('js/app.js') }}"></script>

@endsection