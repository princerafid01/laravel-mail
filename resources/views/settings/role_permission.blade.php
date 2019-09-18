@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-content">
            <h4 class="card-title">Role permission</h4>
            <p>Assign permission to the group</p>
            <div class="row">
                <form action="{{route('RolePermissionPost', ['role_id'=>$role->id])}}" method="post">
                    @csrf
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 30%">Module</th>
                                <th style="width: 30%;">Function</th>
                                <th>View</th>
                                <th>Add</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Ship</td>
                            <td>Report</td>
                            <td>
                                <label>
                                    <input type="checkbox" value="19" class="filled-in" name="permissions[]" @if($role->hasPermission('ship_view'))checked @endif >
                                    <span></span>
                                </label>
                            </td>
                        </tr>
                            <tr>
                                <td>Trip</td>
                                <td>Trip</td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="1" class="filled-in" name="permissions[]" @if($role->hasPermission('trip_view'))checked @endif >
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="2" class="filled-in" name="permissions[]" @if($role->hasPermission('trip_add'))checked @endif >
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="3" class="filled-in" name="permissions[]" @if($role->hasPermission('trip_edit'))checked @endif>
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="4" class="filled-in" name="permissions[]" @if($role->hasPermission('trip_delete'))checked @endif>
                                        <span></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">User</td>
                                <td>User</td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="5" class="filled-in" name="permissions[]" @if($role->hasPermission('user_view'))checked @endif >
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="6" class="filled-in" name="permissions[]" @if($role->hasPermission('user_add'))checked @endif >
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="7" class="filled-in" name="permissions[]" @if($role->hasPermission('user_edit'))checked @endif>
                                        <span></span>
                                    </label>
                                </td>
                                {{--<td>--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" value="8" class="filled-in" name="permissions[]" @if($role->hasPermission('user_delete'))checked @endif>--}}
                                        {{--<span></span>--}}
                                    {{--</label>--}}
                                {{--</td>--}}
                            </tr>
                            <tr>
                                <td>User Password</td>
                                <td></td>
                                <td></td>
                                <td><label>
                                        <input type="checkbox" value="8" class="filled-in" name="permissions[]" @if($role->hasPermission('user_password'))checked @endif >
                                        <span></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Income</td>
                                <td>Income</td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="10" class="filled-in" name="permissions[]" @if($role->hasPermission('income_view'))checked @endif >
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="11" class="filled-in" name="permissions[]" @if($role->hasPermission('income_add'))checked @endif >
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="12" class="filled-in" name="permissions[]" @if($role->hasPermission('income_edit'))checked @endif>
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="13" class="filled-in" name="permissions[]" @if($role->hasPermission('income_delete'))checked @endif>
                                        <span></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Expense</td>
                                <td>Expense</td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="14" class="filled-in" name="permissions[]" @if($role->hasPermission('expense_view'))checked @endif >
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="15" class="filled-in" name="permissions[]" @if($role->hasPermission('expense_add'))checked @endif >
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="16" class="filled-in" name="permissions[]" @if($role->hasPermission('expense_edit'))checked @endif>
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" value="17" class="filled-in" name="permissions[]" @if($role->hasPermission('expense_delete'))checked @endif>
                                        <span></span>
                                    </label>
                                </td>
                            </tr>
                        <tr>
                            <td>General Expense</td>
                            <td>General Expense</td>
                            <td>
                                <label>
                                    <input type="checkbox" value="21" class="filled-in" name="permissions[]" @if($role->hasPermission('gexpense_view'))checked @endif >
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <label>
                                    <input type="checkbox" value="22" class="filled-in" name="permissions[]" @if($role->hasPermission('gexpense_add'))checked @endif >
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <label>
                                    <input type="checkbox" value="23" class="filled-in" name="permissions[]" @if($role->hasPermission('gexpense_edit'))checked @endif>
                                    <span></span>
                                </label>
                            </td>
                            <td>
                                <label>
                                    <input type="checkbox" value="24" class="filled-in" name="permissions[]" @if($role->hasPermission('gexpense_delete'))checked @endif>
                                    <span></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Misc.
                            </td>
                            <td colspan="9">
                                <label>
                                    <input type="checkbox" value="9" class="filled-in" name="permissions[]" @if($role->hasPermission('view_all'))checked @endif>
                                    <span>View All record</span>
                                </label>
                                <label class="ml-1">
                                <input type="checkbox" value="18" class="filled-in" name="permissions[]" @if($role->hasPermission('date'))checked @endif>
                                    <span>Date manipulate</span>
                                </label>
                                <label class="ml-1">
                                <input type="checkbox" value="20" class="filled-in" name="permissions[]" @if($role->hasPermission('notify_all'))checked @endif>
                                <span>Notify all</span>
                                </label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn gradient-45deg-green-teal waves-effect waves-light right" type="submit" name="action">Save
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection