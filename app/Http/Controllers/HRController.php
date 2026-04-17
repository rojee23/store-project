<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HRController extends Controller
{
    // HR Dashboard
    public function dashboard()
    {
        return view('hr.dashboard');
    }

    // Create Employee Page
    public function createEmployee()
    {
        return view('hr.create-employee');
    }

    // Store Employee (Simulation Only)
    public function storeEmployee(Request $request)
    {
        return "Employee data received (simulation only – no database yet)";
    }
}
