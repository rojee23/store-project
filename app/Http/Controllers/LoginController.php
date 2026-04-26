<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // ============================
    //      LOGIN PAGE
    // ============================
    public function loginPage()
    {
        return view('login');
    }

    // ============================
    //      LOGIN ACTION
    // ============================
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->username;
        $password = $request->password;

        // Fetch user from USER table
        $user = DB::table('USER')
            ->where('username', $username)
            ->first();

        // Check username
        if (!$user) {
            return back()->with('error', 'Invalid username');
        }

        // Check password (no hashing as required)
        if ($user->password !== $password) {
            return back()->with('error', 'Incorrect password');
        }

        // Check account status (1 = active)
        if ($user->account_status != 1) {
            return back()->with('error', 'Account is disabled');
        }

        // Store session data
        Session::put('user_id', $user->user_id);
        Session::put('username', $user->username);
        Session::put('logged_in', true);

        // Redirect to HR dashboard
        return redirect()->route('hr.dashboard');
    }

    // ============================
    //      LOGOUT
    // ============================
    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
