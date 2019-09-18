<?php

namespace App\Http\Controllers;

use App\Notifications\GeneralEmailNotification;
use App\Notifications\GeneralNotification;
use App\Notifications\WelcomeUser;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index(){
        $loggeduser = Auth::user();
        if (! $loggeduser->can('user_view'))
            abort(403);
        $meta = array(
            'page_title' => 'Users',
            'active_page'=>'users',
            'active_menu'=> 'users',
            'bc'=> array(
                'Home' => url('/'),
                'Users'=>'active',
            ),
        );
        $users = User::whereNotIn('id',[1])->with('role')->with('created_by');
        if (!$loggeduser->can('view_all')){
            $users = $users->where('user_id', $loggeduser->id);
        }
        $users = $users->get();
        return view('users.index', compact('meta', 'users'));
    }
    public function addUser(Request $request){
        $loggedUser = Auth::user();
        if (! $loggedUser->can('user_add'))
            abort(403);
        if ($request->isMethod('post')){
            Validator::make($request->all(),[
                'name'=>'required',
                'phone'=>'required|numeric',
                'email' =>'required|unique:users',
                'password' => 'required|confirmed',
                'role'=>'required'
            ])->validate();
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->role_id = $request->input('role');
            $user->phone = $request->input('phone');
            $user->creator = $loggedUser->id;
            $user->save();
            $user->attachRole($request->input('role'));
            $users = User::where('active','1')->whereHas('roles.perms', function($query) {$query->whereName('notify_all');})->get();
            Notification::send($users, new GeneralNotification('New '.Role::find($request->input('role'))->name.' '.$user->name.' has been added by '.$loggedUser->name));
            if($request->input('notify')){
                $user->notify(new WelcomeUser($user->email,$request->input('password')));
            }
            $request->session()->flash('success', 'User added');
            return redirect(route('users'));
        }
        $meta = array(
            'page_title' => 'Add Users',
            'active_page'=>'users',
            'active_menu'=> 'users',
            'bc'=> array(
                'Home' => url('/'),
                'Users'=>route('users'),
                'Add user'=>'active'
            ),
        );
        $roles = Role::whereNotIn('id',[1])->get();
        return view('users.add_user', compact('meta', 'roles'));
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
}
