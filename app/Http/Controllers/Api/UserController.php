<?php

namespace App\Http\Controllers\Api;

use App\Notifications\GeneralNotification;
use App\Notifications\WelcomeUser;
use App\Role;
use App\User;
use function Composer\Autoload\includeFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('jwt.auth');
    }

    public function index(){
        $loggeduser = Auth::user();
        if (! $loggeduser->can('user_view'))
            abort(403);
        $users = User::whereNotIn('id',[1])->with('role')->with('created_by');
        if (!$loggeduser->can('view_all')){
            $users = $users->where('user_id', $loggeduser->id);
        }
        $users = $users->get();
        return $users;
    }
    public function addUser(Request $request){
        if ($request->filled('user_id')){
            $loggedUser = Auth::user();
            if (! $loggedUser->can('user_edit'))
                abort(403);
            $user = User::findOrfail($request->input('user_id'));
            $validate = [
                'name'=>'required',
                'phone'=>'required|numeric',
                'password' => 'confirmed',
                'role_id'=>'required',
            ];
            if ($request->input('email') != $user->email)
                $validate['email'] = 'required|unique:users';
            Validator::make($request->all(),$validate)->validate();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $notify = false;
            if ($loggedUser->can('user_password') && $request->filled('password')){
                $user->password = bcrypt($request->input('password'));
                $notify = true;
            }elseif($request->filled('password')){
                return response()->json([
                    'status' => 'error',
                    'notify' => [
                        'title' => 'Error !',
                        'type' => 'error',
                        'message' => ' You are not allowed to update User password'
                    ]
                ]);
            }
            $user->role_id = $request->input('role_id');
            $user->active = $request->input('status') == 'Active'? 1:0;
            $user->phone = $request->input('phone');
            $user->save();
            $user->roles()->sync([$request->input('role_id')]);
            if($request->input('notify') && $notify){
                $user->notify(new GeneralNotification('Your Password has been reset to '.$request->input('password')));
            }
            return response()->json([
                'status' => 'success',
                'notify' => [
                    'title' => 'Successful !',
                    'type' => 'success',
                    'message' => ' User updated'
                ]
            ]);
        }else{
            $loggedUser = Auth::user();
            if (! $loggedUser->can('user_add'))
                abort(403);
            Validator::make($request->all(),[
                'name'=>'required',
                'phone'=>'required|numeric',
                'email' =>'required|unique:users',
                'password' => 'required|confirmed',
                'role_id'=>'required',
            ])->validate();
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->role_id = $request->input('role_id');
            $user->phone = $request->input('phone');
            $user->creator = $loggedUser->id;
            $user->active = $request->input('status') == 'Active'? 1:0;
            $user->save();
            $user->attachRole($request->input('role_id'));
            $users = User::where('active','1')->whereHas('roles.perms', function($query) {$query->whereName('notify_all');})->get();
            Notification::send($users, new GeneralNotification('New '.Role::find($request->input('role_id'))->name.' '.$user->name.' has been added by '.$loggedUser->name));
            if($request->input('notify')){
                $user->notify(new GeneralNotification('New account has been created for you at https://nnslbd.com. Your login email: '.$user->email.' and password: '.$request->input('password')));
            }
            return response()->json([
                'status' => 'success',
                'notify' => [
                    'title' => 'Successful !',
                    'type' => 'success',
                    'message' => ' User Added'
                ]
            ]);
        }
    }
    public function editUser(Request $request, $id){
        if (! Auth::user()->can('user_edit'))
            abort(403);
        $user = User::findOrfail($id);
        if ($request->isMethod('post')){
            $rules = [
                'name'=>'required',
                'role'=>'required',
                'password'=>'confirmed',
                'phone'=>'required|numeric',
            ];
            if ($request->input('email') != $user->email )
                $roles['email'] = 'required|unique:users';
            Validator::make($request->all(),$rules)->validate();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if (Auth::user()->can('user_password') && $request->filled('password')){
                $user->password = bcrypt($request->input('password'));
            }elseif($request->filled('password')){
                $request->session()->flash('error', 'You are not allowed to update User password');
            }
            $user->role_id = $request->input('role');
            $user->active = $request->input('status');
            $user->phone = $request->input('phone');
            $user->save();
            $user->roles()->sync([$request->input('role')]);
            $request->session()->flash('success', 'User updated');
            return redirect(route('users'));
        }
        $meta = array(
            'page_title' => 'Edit Users',
            'active_page'=>'users',
            'active_menu'=> 'users',
            'bc'=> array(
                'Home' => url('/'),
                'Users'=>route('users'),
                'Edit user'=>'active'
            ),
        );
        $roles = Role::whereNotIn('id',[1])->get();
        return view('users.edit_user', compact('meta', 'roles', 'user'));
    }
    public function profile(Request $request){
        $loggedUser = Auth::user();
        if ($request->isMethod('post')){
            Validator::extend('old_password', function ($attribute, $value, $parameters, $validator){
                return Hash::check($value, current($parameters));
            });
            $validate = [
                'phone' =>'required|numeric'
            ];
            if ($loggedUser->hasRole('super_admin')){
                $validate['name'] = 'required|string';
            }
            Validator::make($request->all(), $validate)->validate();
//            $loggedUser->password = bcrypt($request->input('password'));
            if($request->filled('name'))
                $loggedUser->name = $request->input('name');
            $loggedUser->phone = $request->input('phone');
            $loggedUser->save();
        }
        $meta = array(
            'page_title' => 'Profile',
            'active_page'=>'users',
            'active_menu'=> 'users',
            'bc'=> array(
                'Home' => url('/'),
                'Profile'=>'active'
            ),
        );
        return view('users.profile', compact('meta', 'loggedUser'));

    }
    public function roles(){
        $roles = Role::select('id', 'display_name as label')->whereNotIn('id',[1])->get();
        return $roles;
    }
    public function getUser($id){
        $user = User::with('role')->findOrFail($id);
        return $user;
    }
    public function addRole(Request $request){
        $loggeduser = Auth::user();
        if (! $loggeduser->hasRole('super_admin'))
            abort(403);
        if ($request->filled('role_id')){
            Validator::make($request->all(),[
                'role_name'=>'required|string',
            ])->validate();
            $r = Role::find($request->input('role_id'));
            $r->name = Str::slug($request->input('role_name'),'-');
            $r->display_name = $request->input('role_name');
            $r->save();
            return response()->json([
                'status' => 'success',
                'notify' => [
                    'title' => 'Success !',
                    'type' => 'success',
                    'message' => 'Role Has been Updated!'
                ]
            ]);
        }else{
            Validator::make($request->all(),[
                'role_name'=>'required|string',
            ])->validate();
            $r = new Role;
            $r->name = Str::slug($request->input('role_name'),'-');
            $r->display_name = $request->input('role_name');
            $r->save();
            return response()->json([
                'status' => 'success',
                'notify' => [
                    'title' => 'Success !',
                    'type' => 'success',
                    'message' => 'Role Has been Created'
                ]
            ]);

        }
    }
    public function deleteRole($id){
        $loggeduser = Auth::user();
        if (! $loggeduser->hasRole('super_admin'))
            abort(403);
        if (User::where('role_id', $id)->count()>0){
            return response()->json([
                'status' => 'error',
                'notify' => [
                    'title' => 'Error!',
                    'type' => 'warning',
                    'message' => 'Can Not delete, Role has users'
                ]
            ]);
        }
        if (Role::destroy($id)){
            return response()->json([
                'status' => 'success',
                'notify' => [
                    'title' => 'Success !',
                    'type' => 'success',
                    'message' => 'Role Has been Deleted'
                ]
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'notify' => [
                    'title' => 'Error!',
                    'type' => 'danger',
                    'message' => 'Something went wrong'
                ]
            ]);
        }
    }
    public function perms(Request $request, $id){
        if ($request->isMethod('post')){
            Role::findOrfail($id)->perms()->sync($request->input('permissions'));
            return response()->json([
                'status' => 'success',
                'notify' => [
                    'title' => 'Success !',
                    'type' => 'success',
                    'message' => 'Role Permission has been updated'
                ]
            ]);
        }else{
            $perms = Role::findOrfail($id)->perms()->select('id')->get();
            $data = array();
            foreach ($perms as $p){
                $data[] = (string)$p->id;
            }
            return $data;

        }

    }
}
