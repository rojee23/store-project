<?php
/*
    Project: Multi-Branch E-Store
    Student Name:  روچينا بوظو
    Student ID: 202211280
    Class: C6
*/
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
        // VALIDATION
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // GET USER
        $user = DB::table('USER')
            ->where('username', $request->username)
            ->first();

        // USER NOT FOUND
        if (!$user) {
            return back()->with('error', 'Invalid username');
        }

        // WRONG PASSWORD
        if ($user->password !== $request->password) {
            return back()->with('error', 'Incorrect password');
        }

        // ACCOUNT DISABLED
        if ($user->account_status != 1) {
            return back()->with('error', 'Account is disabled');
        }

        // GET PERSONAL INFO
        $person = DB::table('PERSONAL_INFORMATION')
            ->where('user_id', $user->user_id)
            ->first();

        if (!$person) {
            return back()->with('error', 'No personal information found for this user');
        }

        // GET ROLE
        $role = DB::table('ROLE')
            ->where('role_id', $person->role_id)
            ->first();

        // STORE SESSION
        Session::put('user_id', $user->user_id);
        Session::put('username', $user->username);
        Session::put('logged_in', true);
        Session::put('role_type', $role->type);

        // REDIRECT BASED ON ROLE — SUCCESS AS ALERT
        if ($role->type === 'HR Officer') {
            return redirect()->route('hr.dashboard')->with('success', 'Login successful!');
        }

        if ($role->type === 'Manager') {
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }

        // DEFAULT → STORES DASHBOARD
        return redirect()->route('dashboard')->with('success', 'Login successful!');
    }

    public function logout()
    {
        Session::flush();

        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
