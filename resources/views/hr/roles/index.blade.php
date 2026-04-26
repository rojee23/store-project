<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Roles</title>

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
                <i class="fas fa-id-badge"></i>
            </div>
            <h2>Manage Roles</h2>
            <p>Roles Management</p>
        </div>

        <div class="card-body">

            <!-- Add Role Button -->
            <button class="btn-login mb-3 w-100" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                <span>Add New Role</span>
                <i class="fas fa-plus"></i>
            </button>

            <!-- Roles Table -->
            <div class="table-responsive">
                <table class="table table-bordered text-center bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->role_id }}</td>

                                <!-- FIXED: use 'type' instead of 'role_name' -->
                                <td>{{ $role->type }}</td>

                                <td>
                                    <!-- Edit -->
                                    <button class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editRoleModal{{ $role->role_id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Delete -->
                                    <a href="/hr/roles/delete/{{ $role->role_id }}"
                                       class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editRoleModal{{ $role->role_id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5>Edit Role</h5>
                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="/hr/roles/update/{{ $role->role_id }}" method="POST">
                                            @csrf

                                            <div class="modal-body">
                                                <label class="form-label">Role Name</label>

                                                <!-- FIXED: use value="{{ $role->type }}" -->
                                                <input type="text" name="role_name"
                                                       class="form-control"
                                                       value="{{ $role->type }}" required>
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

<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Add New Role</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="/hr/roles/store" method="POST">
                @csrf

                <div class="modal-body">
                    <label class="form-label">Role Name</label>
                    <input type="text" name="role_name" class="form-control" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Add Role</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
