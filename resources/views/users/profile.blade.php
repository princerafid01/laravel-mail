@extends('layouts.master')
@section('content')
    <div class="col s12 m6 l6 animate fadeLeft">
        <div class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title mb-0">Personal Info</h4>
                <ul class="collection">
                    <li class="collection-item">Name: {{$loggedUser->name}}</li>
                    <li class="collection-item">Email: {{$loggedUser->email}}</li>
                    <li class="collection-item">Phone: {{$loggedUser->phone}}</li>
                    <li class="collection-item">Role: {{$loggedUser->role->display_name}}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col s12 m6 l6 animate fadeLeft">
        <div class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title mb-0">Update Info</h4>
                <form id="add_user_form" method="post" action="{{route('profilePost')}}">
                    @csrf
                @role('super_admin')
                <div class="input-field col s12">
                    <input id="name" name="name" value="{{$loggedUser->name}}" type="text" required>
                    <label for="name">Name *</label>
                </div>
                @endrole
                <div class="input-field col s12">
                    <input id="phone" name="phone" type="text" value="{{$loggedUser->phone}}" required>
                    <label for="phone">Phone *</label>
                </div>
                <div class="input-field col s12">
                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update
                        <i class="material-icons right">send</i>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
{{--    <div class="col s12 m6 l6 animate fadeRight">--}}
{{--        <div class="card card card-default scrollspy">--}}
{{--            <div class="card-content">--}}
{{--                <h4 class="card-title mb-0">Change Password</h4>--}}
{{--                @if($errors->any())--}}
{{--                    <div class="card-alert card red">--}}
{{--                        <div class="card-content white-text">--}}
{{--                            @foreach($errors->all() as $m)--}}
{{--                                <p>{{$m}}</p>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">--}}
{{--                            <span aria-hidden="true">×</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <form class="col s12" id="add_user_form" method="post" action="{{route('profilePost')}}">--}}
{{--                    @csrf--}}
{{--                    <div class="row">--}}
{{--                        <div class="input-field col s12">--}}
{{--                            <input id="old_password" name="old_password" type="password" required autocomplete="old-password">--}}
{{--                            <label for="old_password">Old Password *</label>--}}
{{--                        </div>--}}
{{--                        <div class="input-field col s12">--}}
{{--                            <input id="password" name="password" type="password" required autocomplete="new-password">--}}
{{--                            <label for="password">New Password *</label>--}}
{{--                        </div>--}}
{{--                        <div class="input-field col s12">--}}
{{--                            <input id="password-confirm" name="password_confirmation" type="password"  required autocomplete="new-password">--}}
{{--                            <label for="password-confirm">Confirm Password *</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="input-field col s12">--}}
{{--                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update--}}
{{--                                <i class="material-icons right">send</i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
@section('other_java')
    <script src="{{asset('/')}}assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script>
        $("#add_user_form").validate({
            rules: {
                'password': "required",
                'old_password': "required",
                'password-confirmation': "required",

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