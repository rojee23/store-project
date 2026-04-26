<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\EmployeeStatus;
use App\Models\PersonalInformation;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HRController extends Controller
{
    // ============================
    // LOGIN PROTECTION
    // ============================
    private function checkLogin()
    {
        if (!session()->has('logged_in')) {
            return redirect()->route('login')->with('error', 'Please login first');
        }
    }

    // ============================
    // HR DASHBOARD
    // ============================
    public function dashboard()
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        return view('hr.dashboard');
    }

    // ============================
    // LIST EMPLOYEES
    // ============================
    public function employees()
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $employees = PersonalInformation::whereNotNull('department_id')->get();
        $departments = Department::all();
        $roles = Role::all();
        $statuses = EmployeeStatus::all();

        return view('hr.employees.index', compact('employees', 'departments', 'roles', 'statuses'));
    }

    // ============================
    // CREATE EMPLOYEE
    // ============================
    public function createEmployee()
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $departments = Department::all();
        $roles = Role::all();
        $statuses = EmployeeStatus::all();

        return view('hr.employees.create', compact('departments', 'roles', 'statuses'));
    }

    // ============================
    // STORE EMPLOYEE
    // ============================
    public function storeEmployee(Request $request)
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        // ⭐ VALIDATION لمنع overflow
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'birthday' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:1,10',
            'national_number' => 'nullable|numeric|digits_between:1,10',
            'department_id' => 'required',
            'role_id' => 'required',
            'employee_status_id' => 'required',
        ]);

        $data = $request->all();

        // رفع الصورة
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
    // EDIT EMPLOYEE
    // ============================
    public function editEmployee($id)
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $employee = PersonalInformation::findOrFail($id);
        $departments = Department::all();
        $roles = Role::all();
        $statuses = EmployeeStatus::all();

        return view('hr.employees.edit', compact('employee', 'departments', 'roles', 'statuses'));
    }

    // ============================
    // UPDATE EMPLOYEE
    // ============================
    public function updateEmployee(Request $request, $id)
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $employee = PersonalInformation::findOrFail($id);

        // ⭐ نفس VALIDATION لمنع overflow
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'birthday' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:1,10',
            'national_number' => 'nullable|numeric|digits_between:1,10',
            'department_id' => 'required',
            'role_id' => 'required',
            'employee_status_id' => 'required',
        ]);

        $data = $request->all();

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
    // DELETE EMPLOYEE
    // ============================
    public function deleteEmployee($id)
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $employee = PersonalInformation::findOrFail($id);

        if ($employee->department_id !== null) {
            return redirect()->back()->with('error', 'Cannot delete employee assigned to a department');
        }

        $employee->delete();

        return redirect()->route('hr.employees')->with('success', 'Employee deleted successfully');
    }

    // ============================
    // SHOW EMPLOYEE DETAILS
    // ============================
    public function showEmployee($id)
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $employee = PersonalInformation::findOrFail($id);

        return view('hr.employees.show', compact('employee'));
    }

    // ============================
    // SEARCH EMPLOYEES (AJAX)
    // ============================
    public function searchEmployees(Request $request)
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $firstName = $request->firstName ?: null;
        $department_id = $request->department_id ?: null;
        $role_id = $request->role_id ?: null;
        $employee_status_id = $request->employee_status_id ?: null;

        $employees = DB::select('EXEC SP_SearchEmployees ?, ?, ?, ?', [
            $firstName,
            $department_id,
            $role_id,
            $employee_status_id,
        ]);

        return response()->json($employees);
    }

    // ============================
    // MANAGE DEPARTMENTS
    // ============================
    public function departments()
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $departments = Department::all();

        return view('hr.departments.index', compact('departments'));
    }

    public function storeDepartment(Request $request)
    {
        if ($redirect = $this->checkLogin()) return $redirect;

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
        if ($redirect = $this->checkLogin()) return $redirect;

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
        if ($redirect = $this->checkLogin()) return $redirect;

        $count = PersonalInformation::where('department_id', $id)->count();

        if ($count > 0) {
            return back()->with('error', 'Cannot delete department with assigned employees');
        }

        Department::where('department_id', $id)->delete();

        return back()->with('success', 'Department deleted successfully');
    }

    // ============================
    // MANAGE ROLES
    // ============================
    public function roles()
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $roles = Role::all();

        return view('hr.roles.index', compact('roles'));
    }

    public function storeRole(Request $request)
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $request->validate([
            'role_name' => 'required',
        ]);

        Role::create([
            'type' => $request->role_name,
        ]);

        return back()->with('success', 'Role added successfully');
    }

    public function updateRole(Request $request, $id)
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $request->validate([
            'role_name' => 'required',
        ]);

        Role::where('role_id', $id)->update([
            'type' => $request->role_name,
        ]);

        return back()->with('success', 'Role updated successfully');
    }

    public function deleteRole($id)
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $count = PersonalInformation::where('role_id', $id)->count();

        if ($count > 0) {
            return back()->with('error', 'Cannot delete role assigned to employees');
        }

        Role::where('role_id', $id)->delete();

        return back()->with('success', 'Role deleted successfully');
    }

    // ============================
    // EMPLOYEE STATUS
    // ============================
    public function status()
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $statuses = EmployeeStatus::all();

        return view('hr.status.index', compact('statuses'));
    }

    public function storeStatus(Request $request)
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $request->validate([
            'status_name' => 'required',
        ]);

        EmployeeStatus::create([
            'status' => $request->status_name,
        ]);

        return back()->with('success', 'Status added successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $request->validate([
            'status_name' => 'required',
        ]);

        EmployeeStatus::where('employee_status_id', $id)->update([
            'status' => $request->status_name,
        ]);

        return back()->with('success', 'Status updated successfully');
    }

    public function deleteStatus($id)
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $count = PersonalInformation::where('employee_status_id', $id)->count();

        if ($count > 0) {
            return back()->with('error', 'Cannot delete status assigned to employees');
        }

        EmployeeStatus::where('employee_status_id', $id)->delete();

        return back()->with('success', 'Status deleted successfully');
    }
}
