<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Employee</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Theme -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>

<body>

<!-- Background shapes -->
<div class="shape"></div>
<div class="shape"></div>
<div class="shape"></div>
<div class="shape"></div>

<div class="login-container">
    <div class="login-card">

        <div class="card-header">
            <div class="header-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2>Add New Employee</h2>
            <p>Employee Registration Form</p>
        </div>

        <div class="card-body">

            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('hr.employees') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Employees
                </a>
            </div>

            <!-- ⭐ عرض الأخطاء -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>There were some problems with your input:</strong>
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('hr.employee.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="firstName" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lastName" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Father Name</label>
                        <input type="text" name="father" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mother Name</label>
                        <input type="text" name="mother" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Birthday</label>
                        <input type="date" name="birthday" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">National Number</label>
                        <input type="text" name="national_number" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Salary</label>
                        <input type="number" name="salary" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Department</label>
                        <select name="department_id" class="form-select" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $d)
                                <option value="{{ $d->department_id }}">{{ $d->department_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Role</label>
                        <select name="role_id" class="form-select" required>
                            <option value="">Select Role</option>
                            @foreach($roles as $r)
                                <option value="{{ $r->role_id }}">{{ $r->type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Employee Status</label>
                        <select name="employee_status_id" class="form-select" required>
                            <option value="">Select Status</option>
                            @foreach($statuses as $s)
                                <option value="{{ $s->employee_status_id }}">{{ $s->status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Upload Employee Photo</label>
                        <input type="file" name="upload_file" class="form-control">
                    </div>

                </div>

                <button type="submit" class="btn-login w-100 mt-3">
                    <span>Save Employee</span>
                    <i class="fas fa-save"></i>
                </button>

            </form>

        </div>

        <div class="card-footer">
            <small>&copy; 2026 Multi-Branch E-Store. All rights reserved.</small>
        </div>

    </div>
</div>

</body>
</html>
