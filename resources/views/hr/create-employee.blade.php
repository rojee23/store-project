<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>

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
            <h2>Add Employee</h2>
            <p>Insert Personal Information</p>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('hr.employee.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>First Name</label>
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>National ID</label>
                    <div class="input-group">
                        <i class="fas fa-id-card input-icon"></i>
                        <input type="text" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Birth Date</label>
                    <div class="input-group">
                        <i class="fas fa-calendar input-icon"></i>
                        <input type="date" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <div class="input-group">
                        <i class="fas fa-phone input-icon"></i>
                        <input type="text" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Department</label>
                    <div class="input-group">
                        <i class="fas fa-building input-icon"></i>
                        <select class="form-control">
                            <option>Human Resources</option>
                            <option>Marketing</option>
                            <option>Warehouse</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <div class="input-group">
                        <i class="fas fa-id-badge input-icon"></i>
                        <select class="form-control">
                            <option>Manager</option>
                            <option>Employee</option>
                            <option>Marketer</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <div class="input-group">
                        <i class="fas fa-user-check input-icon"></i>
                        <select class="form-control">
                            <option>Active</option>
                            <option>Fired</option>
                            <option>On Leave</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Profile Image</label>
                    <div class="input-group">
                        <i class="fas fa-image input-icon"></i>
                        <input type="file" class="form-control">
                    </div>
                </div>

                <button class="btn-login w-100 mt-3">
                    <span>Submit</span>
                    <i class="fas fa-check"></i>
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
