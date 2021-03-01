<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Admin;
use Auth;
use DB;

class AuthAdminController extends Controller
{
    public function __construct()
    {
    	$this->middleware('guest:web')->except('logout');
    	$this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login.login');
    }

    public function login(Request $request){
        $this->validate($request,[
            'password' => 'min:1'
        ]);

        $credential = [
            'username' => $request->username,
            'password' => $request->password,

        ];

        if (Auth::guard('admin')->attempt($credential, $request->member)){
            $admin = Admin::find(Auth::guard('admin')->user()->no);
            $admsdp = DB::table('admins')
            ->select('*')
            ->where('nik', '=', $admin->nik)
            ->first();

            if(!empty($admsdp->nik)){
                return redirect()->route('home');
            }
            else {
                Auth::guard('admin')->logout();
                return redirect()->back()->withInput($request->only('username', 'remember'))->with('alertunauth','Maaf, Anda tidak punya hak akses yah~');
            }            
        }
        return redirect()->back()->withInput($request->only('username', 'remember'))->with('alert','Username atau Password salah, silahkan coba lagi yah~');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('showlogin');
    }
}
