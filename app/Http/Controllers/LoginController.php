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
        // التحقق من الإدخال
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // جلب المستخدم من جدول USER
        $user = DB::table('USER')
            ->where('username', $request->username)
            ->first();

        // التحقق من وجود المستخدم
        if (!$user) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Invalid username'
            ]);
        }

        // التحقق من كلمة المرور
        if ($user->password !== $request->password) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Incorrect password'
            ]);
        }

        // التحقق من حالة الحساب
        if ($user->account_status != 1) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'Account is disabled'
            ]);
        }

        // جلب بيانات الموظف من PERSONAL_INFORMATION
        $person = DB::table('PERSONAL_INFORMATION')
            ->where('user_id', $user->user_id)
            ->first();

        if (!$person) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'No personal information found for this user'
            ]);
        }

        // جلب الدور من جدول ROLE
        $role = DB::table('ROLE')
            ->where('role_id', $person->role_id)
            ->first();

        // تخزين الجلسة
        Session::put('user_id', $user->user_id);
        Session::put('username', $user->username);
        Session::put('logged_in', true);
        Session::put('role_type', $role->type); // مثال: HR Officer, Manager, Employee...

        // التوجيه حسب الدور
        if ($role->type === 'HR Officer') {
            return redirect()->route('hr.dashboard')->with('toast', [
                'type' => 'success',
                'message' => 'Login successful!'
            ]);
        }

        if ($role->type === 'Manager') {
            return redirect()->route('stores.index')->with('toast', [
                'type' => 'success',
                'message' => 'Login successful!'
            ]);
        }

        // باقي الأدوار → نفس الـ dashboard
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
