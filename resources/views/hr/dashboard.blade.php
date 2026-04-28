<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HR Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>

<body>

<div class="toast-container" id="toastContainer"></div>

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
                <a href="{{ route('hr.employee.create') }}" class="btn-login text-center">
                    <span>Add New Employee</span>
                    <i class="fas fa-user-plus"></i>
                </a>

                <a href="{{ route('hr.employees') }}" class="btn-login text-center">
                    <span>View Employees</span>
                    <i class="fas fa-list"></i>
                </a>

                <a href="{{ route('hr.departments') }}" class="btn-login text-center">
                    <span>Manage Departments</span>
                    <i class="fas fa-building"></i>
                </a>

                <a href="{{ route('hr.roles') }}" class="btn-login text-center">
                    <span>Manage Roles</span>
                    <i class="fas fa-id-badge"></i>
                </a>

                <a href="{{ route('hr.status') }}" class="btn-login text-center">
                    <span>Employee Status</span>
                    <i class="fas fa-user-check"></i>
                </a>

                <a href="{{ route('logout') }}" class="btn-logout text-center">
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

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const toastData = @json(session('toast'));

        if (!toastData) return;

        const container = document.getElementById('toastContainer');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = 'my-toast ' + (toastData.type ?? '');

        toast.innerHTML = `
            <i class="fas fa-info-circle"></i>
            <span>${toastData.message}</span>
        `;

        container.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 4000);
    });
</script>

</body>
</html>
