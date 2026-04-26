<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HR Dashboard</title>

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
                <i class="fas fa-users"></i>
            </div>
            <h2>HR Dashboard</h2>
            <p>Human Resources Management</p>
        </div>

        <div class="card-body">

            <div class="d-grid gap-3">

                <!-- Add New Employee -->
                <a href="{{ route('hr.employee.create') }}" class="btn-login text-center">
                    <span>Add New Employee</span>
                    <i class="fas fa-user-plus"></i>
                </a>

                <!-- View Employees -->
                <a href="{{ route('hr.employees') }}" class="btn-login text-center">
                    <span>View Employees</span>
                    <i class="fas fa-list"></i>
                </a>

                <!-- Manage Departments -->
                <a href="{{ route('hr.departments') }}" class="btn-login text-center">
                    <span>Manage Departments</span>
                    <i class="fas fa-building"></i>
                </a>

                <!-- Manage Roles -->
                <a href="{{ route('hr.roles') }}" class="btn-login text-center">
                    <span>Manage Roles</span>
                    <i class="fas fa-id-badge"></i>
                </a>

                <!-- Employee Status -->
                <a href="{{ route('hr.status') }}" class="btn-login text-center">
                    <span>Employee Status</span>
                    <i class="fas fa-user-check"></i>
                </a>

                <!-- Logout -->
                <a href="{{ route('logout') }}" class="btn-login text-center" style="background: #e74c3c;">
                    <span>Logout</span>
                    <i class="fas fa-sign-out-alt"></i>
                </a>

            </div>

        </div>

        <div class="card-footer">
            <small>&copy; 2026 Multi-Branch E-Store. All rights reserved.</small>
        </div>

    </div>
</div>

</body>
</html>
