<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalInformation;
use App\Models\Department;
use App\Models\Role;
use App\Models\CustomerStatus;

class HRController extends Controller
{
    // ============================
    //        HR DASHBOARD
    // ============================
    public function dashboard()
    {
        return view('hr.dashboard');
    }

    // ============================
    //        LIST EMPLOYEES
    // ============================
    public function employees()
    {
        $employees = PersonalInformation::whereNotNull('department_id')->paginate(10);
        return view('hr.employees.index', compact('employees'));
    }

    // ============================
    //        CREATE EMPLOYEE
    // ============================
    public function createEmployee()
    {
        $departments = Department::all();
        $roles = Role::all();
        $statuses = CustomerStatus::all(); // تُستخدم كحالة الموظف

        return view('hr.employees.create', compact('departments', 'roles', 'statuses'));
    }

    // ============================
    //        STORE EMPLOYEE
    // ============================
    public function storeEmployee(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'birthday' => 'required|date',
            'email' => 'required|email',
            'phone' => 'required',
            'department_id' => 'required',
            'role_id' => 'required',
            'customer_status_id' => 'required',
        ]);

        $data = $request->all();

        // Upload image
        if ($request->hasFile('upload_file')) {
            $file = $request->file('upload_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/employees'), $filename);
            $data['upload_file'] = $filename;
        }

        PersonalInformation::create($data);

        return redirect()->route('hr.employees')->with('success', 'Employee added successfully');
    }

    // ============================
    //        EDIT EMPLOYEE
    // ============================
    public function editEmployee($id)
    {
        $employee = PersonalInformation::findOrFail($id);
        $departments = Department::all();
        $roles = Role::all();
        $statuses = CustomerStatus::all();

        return view('hr.employees.edit', compact('employee', 'departments', 'roles', 'statuses'));
    }

    // ============================
    //        UPDATE EMPLOYEE
    // ============================
    public function updateEmployee(Request $request, $id)
    {
        $employee = PersonalInformation::findOrFail($id);

        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'birthday' => 'required|date',
            'email' => 'required|email',
            'phone' => 'required',
            'department_id' => 'required',
            'role_id' => 'required',
            'customer_status_id' => 'required',
        ]);

        $data = $request->all();

        // Upload new image
        if ($request->hasFile('upload_file')) {
            $file = $request->file('upload_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/employees'), $filename);
            $data['upload_file'] = $filename;
        }

        $employee->update($data);

        return redirect()->route('hr.employees')->with('success', 'Employee updated successfully');
    }

    // ============================
    //        DELETE EMPLOYEE
    // ============================
    public function deleteEmployee($id)
    {
        $employee = PersonalInformation::findOrFail($id);

        // شرط المشروع: لا يمكن حذف موظف مرتبط بقسم
        if ($employee->department_id !== null) {
            return redirect()->back()->with('error', 'Cannot delete employee assigned to a department');
        }

        $employee->delete();

        return redirect()->route('hr.employees')->with('success', 'Employee deleted successfully');
    }

    // ============================
    //        SHOW EMPLOYEE DETAILS
    // ============================
    public function showEmployee($id)
    {
        $employee = PersonalInformation::findOrFail($id);
        return view('hr.employees.show', compact('employee'));
    }

    // ============================
    //        SEARCH EMPLOYEES (AJAX)
    // ============================
    public function searchEmployees(Request $request)
    {
        $query = PersonalInformation::query();

        if ($request->firstName) {
            $query->where('firstName', 'LIKE', '%' . $request->firstName . '%');
        }

        if ($request->department_id) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->role_id) {
            $query->where('role_id', $request->role_id);
        }

        if ($request->customer_status_id) {
            $query->where('customer_status_id', $request->customer_status_id);
        }

        return response()->json($query->get());
    }
}
