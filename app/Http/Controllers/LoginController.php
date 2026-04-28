<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->username;
        $password = $request->password;

        $user = DB::table('USER')
            ->where('username', $username)
            ->first();

        if (!$user) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Invalid username'
            ]);
        }

        if ($user->password !== $password) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Incorrect password'
            ]);
        }

        if ($user->account_status != 1) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Account is disabled'
            ]);
        }

        Session::put('user_id', $user->user_id);
        Session::put('username', $user->username);
        Session::put('logged_in', true);

        return redirect()->route('hr.dashboard')->with('toast', [
            'type' => 'success',
            'message' => 'Login successful!'
        ]);
    }

    public function logout()
    {
        Session::flush();

        return redirect()->route('login')->with('toast', [
            'type' => 'info',
            'message' => 'Logged out successfully'
        ]);
    }
}
