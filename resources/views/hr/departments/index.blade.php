<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Departments</title>

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
                <i class="fas fa-building"></i>
            </div>
            <h2>Manage Departments</h2>
            <p>Departments Management</p>
        </div>

        <div class="card-body">

            <!-- Add Department Button -->
            <button class="btn-login mb-3 w-100" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
                <span>Add New Department</span>
                <i class="fas fa-plus"></i>
            </button>

            <!-- Departments Table -->
            <div class="table-responsive">
                <table class="table table-bordered text-center bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Department Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($departments as $dep)
                            <tr>
                                <td>{{ $dep->department_id }}</td>
                                <td>{{ $dep->department_name }}</td>
                                <td>
                                    <!-- Edit -->
                                    <button class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editDepartmentModal{{ $dep->department_id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Delete -->
                                    <a href="/hr/departments/delete/{{ $dep->department_id }}"
                                       class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editDepartmentModal{{ $dep->department_id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5>Edit Department</h5>
                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="/hr/departments/update/{{ $dep->department_id }}" method="POST">
                                            @csrf

                                            <div class="modal-body">
                                                <label class="form-label">Department Name</label>
                                                <input type="text" name="department_name"
                                                       class="form-control"
                                                       value="{{ $dep->department_name }}" required>
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button class="btn btn-primary">Save Changes</button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

        <div class="card-footer">
            <small>&copy; 2026 Multi-Branch E-Store. All rights reserved.</small>
        </div>

    </div>
</div>

<!-- Add Department Modal -->
<div class="modal fade" id="addDepartmentModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Add New Department</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="/hr/departments/store" method="POST">
                @csrf

                <div class="modal-body">
                    <label class="form-label">Department Name</label>
                    <input type="text" name="department_name" class="form-control" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Add Department</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
