<?php

namespace App\Http\Controllers;

use App\Models\CustomerStatus;
use App\Models\Department;
use App\Models\PersonalInformation;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $employees = PersonalInformation::whereNotNull('department_id')->get();

        $departments = Department::all();
        $roles = Role::all();
        $statuses = CustomerStatus::all();

        return view('hr.employees.index', compact('employees', 'departments', 'roles', 'statuses'));
    }

    // ============================
    //        CREATE EMPLOYEE
    // ============================
    public function createEmployee()
    {
        $departments = Department::all();
        $roles = Role::all();
        $statuses = CustomerStatus::all();

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

        if ($request->hasFile('upload_file')) {
            $file = $request->file('upload_file');
            $filename = time().'_'.$file->getClientOriginalName();
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

        if ($request->hasFile('upload_file')) {
            $file = $request->file('upload_file');
            $filename = time().'_'.$file->getClientOriginalName();
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
        $firstName = $request->firstName ?: null;
        $department_id = $request->department_id ?: null;
        $role_id = $request->role_id ?: null;
        $customer_status_id = $request->customer_status_id ?: null;

        $employees = DB::select('EXEC SP_SearchEmployees ?, ?, ?, ?', [
            $firstName,
            $department_id,
            $role_id,
            $customer_status_id,
        ]);

        return response()->json($employees);
    }

    // ============================
    //        MANAGE DEPARTMENTS
    // ============================
    public function departments()
    {
        $departments = Department::all();

        return view('hr.departments.index', compact('departments'));
    }

    public function storeDepartment(Request $request)
    {
        $request->validate([
            'department_name' => 'required',
        ]);

        Department::create([
            'department_name' => $request->department_name,
        ]);

        return back()->with('success', 'Department added successfully');
    }

    public function updateDepartment(Request $request, $id)
    {
        $request->validate([
            'department_name' => 'required',
        ]);

        Department::where('department_id', $id)->update([
            'department_name' => $request->department_name,
        ]);

        return back()->with('success', 'Department updated successfully');
    }

    public function deleteDepartment($id)
    {
        $count = PersonalInformation::where('department_id', $id)->count();

        if ($count > 0) {
            return back()->with('error', 'Cannot delete department with assigned employees');
        }

        Department::where('department_id', $id)->delete();

        return back()->with('success', 'Department deleted successfully');
    }

    // ============================
    //        MANAGE ROLES
    // ============================
    public function roles()
    {
        $roles = Role::all();

        return view('hr.roles.index', compact('roles'));
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'role_name' => 'required',
        ]);

        Role::create([
            'role_name' => $request->role_name,
        ]);

        return back()->with('success', 'Role added successfully');
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role_name' => 'required',
        ]);

        Role::where('role_id', $id)->update([
            'role_name' => $request->role_name,
        ]);

        return back()->with('success', 'Role updated successfully');
    }

    public function deleteRole($id)
    {
        $count = PersonalInformation::where('role_id', $id)->count();

        if ($count > 0) {
            return back()->with('error', 'Cannot delete role assigned to employees');
        }

        Role::where('role_id', $id)->delete();

        return back()->with('success', 'Role deleted successfully');
    }

    // ============================
    //        EMPLOYEE STATUS
    // ============================
    public function status()
    {
        $statuses = CustomerStatus::all();

        return view('hr.status.index', compact('statuses'));
    }

    public function storeStatus(Request $request)
    {
        $request->validate([
            'status_name' => 'required',
        ]);

        CustomerStatus::create([
            'status_name' => $request->status_name,
        ]);

        return back()->with('success', 'Status added successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_name' => 'required',
        ]);

        CustomerStatus::where('customer_status_id', $id)->update([
            'status_name' => $request->status_name,
        ]);

        return back()->with('success', 'Status updated successfully');
    }

    public function deleteStatus($id)
    {
        $count = PersonalInformation::where('customer_status_id', $id)->count();

        if ($count > 0) {
            return back()->with('error', 'Cannot delete status assigned to employees');
        }

        CustomerStatus::where('customer_status_id', $id)->delete();

        return back()->with('success', 'Status deleted successfully');
    }
}
