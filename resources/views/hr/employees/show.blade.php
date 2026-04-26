<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Details</title>

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
                <i class="fas fa-user"></i>
            </div>
            <h2>Employee Details</h2>
            <p>Full Information</p>
        </div>

        <div class="card-body">

            <div class="text-center mb-4">
                @if($employee->upload_file)
                    <img src="{{ asset('uploads/employees/' . $employee->upload_file) }}"
                         class="rounded-circle" width="120" height="120">
                @else
                    <i class="fas fa-user-circle fa-5x"></i>
                @endif
            </div>

            <h4 class="text-center mb-4">
                {{ $employee->firstName }} {{ $employee->lastName }}
            </h4>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <strong>Father:</strong> {{ $employee->father ?? '-' }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Mother:</strong> {{ $employee->mother ?? '-' }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Birthday:</strong> {{ $employee->birthday }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Gender:</strong> {{ ucfirst($employee->gender) }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>National Number:</strong> {{ $employee->national_number ?? '-' }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Phone:</strong> {{ $employee->phone }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Email:</strong> {{ $employee->email }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Address:</strong> {{ $employee->address ?? '-' }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Salary:</strong> {{ $employee->salary ?? '-' }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Department:</strong>
                    {{ $employee->department->department_name ?? '-' }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Role:</strong>
                    {{ $employee->role->type ?? '-' }}
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Status:</strong>
                    {{ $employee->employeeStatus->status ?? '-' }}
                </div>

            </div>

            <a href="{{ route('hr.employees') }}" class="btn-login w-100 mt-3">
                <span>Back to Employees</span>
                <i class="fas fa-arrow-left"></i>
            </a>

        </div>

        <div class="card-footer">
            <small>&copy; 2026 Multi-Branch E-Store. All rights reserved.</small>
        </div>

    </div>
</div>

</body>
</html>
