@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col s12 m4 l4">
            <!-- Current Balance -->
            <div class="card animate fadeLeft">
                <div class="card-content">
                    <h4 class="card-title mb-0">Role</h4>
                    <form id="Role_form" class="col s12" method="post" action="{{route('RolePost')}}" autocomplete="off">
                        @csrf
                    @if($role)
                        <p class="medium-small">Edit role</p>
                        <input type="hidden" name="role_id" value="{{$role->id}}">
                        @else
                        <p class="medium-small">Add new role</p>
                        @endif


                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="role_name" @if($role) value="{{$role->display_name}}" @endif id="fn">
                                <label for="fn" class="">Role Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">@if($role)Update @else Create @endif
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col s12 m8 l8 animate fadeRight">
            <!-- Total Transaction -->
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title mb-0">Roles</h4>
                    <p class="medium-small">Manage, assign permission to role from here.</p>
                    <table>
                        <thead>
                        <tr>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>

                        </thead>
                        <tbody>
                            @foreach($roles as $r)
                                <tr>
                                    <td>{{$r->display_name}}</td>
                                    <td><a class="tooltipped" data-position="top" data-tooltip="Change permission" href="{{route('RolePermission', ['role_id'=>$r->id])}}"><i class="material-icons">tune</i></a> <a class="tooltipped" data-position="top" data-tooltip="Edit" href="{{route('Role_edit', ['id'=>$r->id])}}"><i class="material-icons">edit</i></a> <a class="tooltipped" data-position="top" data-tooltip="Delete" href="{{route('Role_delete', ['id'=>$r->id])}}"><i class="material-icons">delete</i></a></td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
@section('other_java')
    <script src="{{asset('/')}}assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script>
        $("#Role_form").validate({
            rules: {
                role_name: {
                    required: true
                }
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