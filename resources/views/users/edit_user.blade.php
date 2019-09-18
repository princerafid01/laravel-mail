@extends('layouts.master')
@section('content')
    <div class="col s12 m12 l12">
        <div class="card card card-default scrollspy">
            <div class="card-content">
                @if($errors->any())
                <div class="card-alert card red">
                    <div class="card-content white-text">
                        @foreach($errors->all() as $m)
                            <p>{{$m}}</p>
                        @endforeach
                    </div>
                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                <form class="col s12" id="add_user_form" method="post" action="{{route('editUserPost', ['id'=>$user->id])}}">
                    @csrf
                    <div class="row">
                        <div class="input-field col m4">
                            <input id="name" name="name" type="text" value="{{old('name')?:$user->name}}" required>
                            <label for="name">Full Name *</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="email" name="email" type="email" value="{{old('email')?:$user->email}}" required>
                            <label for="email">Email *</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="phone" name="phone" type="text" value="{{old('phone')?:$user->phone}}" required>
                            <label for="phone">Phone *</label>
                        </div>
                        <div class="input-field col m4">
                            <select name="status" id="status">
                                <option value="1">Active</option>
                                <option value="0" @if($user->active == 0) selected @endif>Inactive</option>
                            </select>
                            <label for="status">Status *</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="password" name="password" type="password" autocomplete="new-password">
                            <label for="password">New Password *</label>
                        </div>
                        <div class="input-field col m4">
                            <input id="password-confirm" name="password_confirmation" type="password" autocomplete="new-password">
                            <label for="password-confirm">Confirm Password *</label>
                        </div>
                        <div class="col m4">
                            <label for="role">Role *</label>
                            <select class="error browser-default" id="role" name="role" data-error=".errorTxt6">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}" @if($user->role_id == $role->id) selected @endif>{{$role->display_name}}</option>
                                    @endforeach
                            </select>
                            <div class="input-field">
                                <div class="errorTxt6"></div>
                            </div>
                        </div>
                        <div class="col m4 input-field">
                            <label class="float-right">
                                <input type="checkbox" class="filled-in" name="notify">
                                <span>Send welcome email to user</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Save
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
@section('other_java')
    <script src="{{asset('/')}}assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script>
        $("#add_user_form").validate({
            rules: {
                name: {
                    required: true
                },
                email:{
                    required: true,
                    email: true,
                }
                role: "required",

            },
            errorElement : 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>
@endsection