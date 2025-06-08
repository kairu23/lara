<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    public function registerView(){
        return view('auth.register');
    }

    public function loginView(){
        return view('auth.login');
    }
    
    public function registerUser(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::create($data);

        if($user){
            return redirect(route(name: 'auth.login'))->with('success', 'Registration Successful');
        }
    }

    public function loginUser(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $request->session()->regenerate();
            return redirect(route('std.index'))->with('success', 'Logged in successfully!');
        }else{
            return redirect(route('auth.login'))->with('fail', 'Logged in failed miserably!');
        }
        
    }

    public function logoutUser(Request $request)
{
    Auth::logout();

    $request->session()->invalidate(); 
    $request->session()->flush();
    $request->session()->regenerateToken(); 

    return redirect()->route('auth.login')->with('success', 'Logged out successfully!');
}

}