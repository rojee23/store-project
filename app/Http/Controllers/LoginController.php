<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        // جلب المستخدم من جدول USER
        $user = DB::table('USER')
            ->where('username', $username)
            ->first();

        if (!$user) {
            return back()->with('error', 'Invalid username');
        }

        if ($user->password !== $password) {
            return back()->with('error', 'Incorrect password');
        }

        // تخزين الجلسة
        Session::put('user_id', $user->user_id);
        Session::put('username', $user->username);
        Session::put('status', $user->account_status);

        return redirect()->route('hr.dashboard');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
