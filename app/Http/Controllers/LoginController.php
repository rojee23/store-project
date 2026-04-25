<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function loginAction(Request $request)
    {

        if ($request->username === 'student1' && $request->password === '1234') {
            return redirect()->route('hr.dashboard');
        }

        return back()->with('error', 'Invalid username or password');
    }
}
