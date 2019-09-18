<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware(['role:super_admin']);
    }
    public function index(Request $request){
        if ($request->isMethod('post')){
            Validator::make($request->all(),[
                'site_name'=>'required',
            ])->validate();
            option(['site_name'=>$request->input('site_name')]);
            option(['date_format'=>$request->input('date_format')]);
            $request->session()->flash('success', 'Settings Updated');
        }
        $meta = array(
            'page_title' => 'System Settings',
            'active_page'=>'system_settings',
            'active_menu'=> 'settings',
            'bc'=> array(
                'Home' => url('/'),
                'Settings'=>url('settings'),
                'System settings' => 'active'
            ),
        );
        return view('settings.index', compact('meta'));
    }
    public function Role(Request $request, $id = null){
        if ($request->isMethod('post')){
            Validator::make($request->all(),[
                'role_name'=>'required|string',
            ])->validate();
            if ($request->filled('role_id')){
                if ($request->input('role_id') == 1){
                    abort('403');
                }
                $r = Role::find($request->input('role_id'));
                $message = 'Role updated';
            }else{
                $r = new Role;
                $message = 'Role created';
            }
            $r->name = Str::slug($request->input('role_name'),'-');
            $r->display_name = $request->input('role_name');
            $r->save();
            $request->session()->flash('success',$message);
            return redirect(route('Role'));
        }else{
            $meta = array(
                'page_title' => 'Role',
                'active_page'=>'role',
                'active_menu'=> 'settings',
                'bc'=> array(
                    'Home' => url('/'),
                    'Settings'=>url('settings'),
                    'Role' => 'active'
                ),
            );
            $role = Role::find($id);
            $roles = Role::whereNotIn('id',[1])->get();
            return view('settings.role', compact('meta','roles','role'));
        }

    }
    public function DeleteRole($id){

            if ($r = Role::destroy($id)){
                session()->flash('success','Role deleted');
                return redirect(route('Role'));
            }
    }
    public function RolePermission(Request $request,$id){
//        if ($id==1)
//            abort(403);
        if ($request->isMethod('post')){
            Role::find($id)->perms()->sync($request->input('permissions'));
            $request->session()->flash('success','Permissions updated');
        }
        $role = Role::findOrfail($id);
        $meta = array(
            'page_title' => 'Role Permission',
            'active_page'=>'role',
            'active_menu'=> 'settings',
            'bc'=> array(
                'Home' => url('/'),
                'Settings'=>url('settings'),
                'Role ('.$role->display_name.')' => route('Role'),
                'Permission' => 'active',
            ),
        );
        return view('settings.role_permission', compact('meta', 'role'));
    }
}
