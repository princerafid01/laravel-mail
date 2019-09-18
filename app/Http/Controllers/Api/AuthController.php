<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Foundation\Auth\ResetsPasswords;

class AuthController extends Controller
{
    use SendsPasswordResetEmails, ResetsPasswords {
        SendsPasswordResetEmails::broker insteadof ResetsPasswords;
        ResetsPasswords::credentials insteadof SendsPasswordResetEmails;
    }
    public function guard(){
        return Auth::Guard('api');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ( ! $token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        if (!Auth::user()->active)
            abort(403);
        return response([
            'status' => 'success'
        ])
            ->header('Authorization', $token);
    }
    public function user(Request $request)
    {
        $user = User::with('role')->find(Auth::user()->id);
        $permissions = array();
        foreach ($user->role->perms()->get() as $per){
            $permissions[] = $per->name;
        }
        $permissions[] = $user->role->name;
        $user->roles = $permissions;
        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }
    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }
    public function logout()
    {
        JWTAuth::invalidate();
        auth()->logout(true);
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully2.'
        ], 200);
    }
    public function forgot(Request $request){
       return $this->sendResetLinkEmail($request);
    }
    public function resetPass(Request $request){
        return $this->reset($request);
    }
}
