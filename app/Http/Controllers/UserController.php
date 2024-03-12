<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{   
    
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => ['required', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required'
        ]);
        
        $fields['password'] = bcrypt($fields['password']);
        $user = User::create($fields);
        auth()->login($user);

        return redirect('/');
    }

    public function login(Request $request){
        $incoming_fields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);
        if (auth()->attempt(['name' => $incoming_fields['loginname'], 'password' => $incoming_fields['loginpassword']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    
}
