<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Roles</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>

<body>

<div class="shape"></div><div class="shape"></div><div class="shape"></div><div class="shape"></div>

<div class="login-container">
    <div class="login-card">

        <div class="card-header">
            <div class="header-icon"><i class="fas fa-id-badge"></i></div>
            <h2>Manage Roles</h2>
            <p>Roles Management</p>
        </div>

        <div class="card-body">

            <div class="mb-3">
                <a href="{{ route('hr.dashboard') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            <button class="btn-login mb-3 w-100" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                <span>Add New Role</span>
                <i class="fas fa-plus"></i>
            </button>

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
                                <td>{{ $role->type }}</td>

                                <td>
                                    <!-- Edit -->
                                    <button class="btn-action-sm btn-edit editBtn"
                                            data-id="{{ $role->role_id }}"
                                            data-name="{{ $role->type }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editRoleModal">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Delete -->
                                    <a onclick="return confirm('Are you sure you want to delete this role?')"
                                       href="{{ route('hr.roles.delete', $role->role_id) }}"
                                       class="btn-action-sm btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
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

<!-- ADD ROLE MODAL -->
<div class="modal fade" id="addRoleModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Add New Role</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('hr.roles.store') }}" method="POST">
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

<!-- EDIT ROLE MODAL -->
<div class="modal fade" id="editRoleModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Edit Role</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editRoleForm" method="POST">
                @csrf

                <div class="modal-body">
                    <label class="form-label">Role Name</label>
                    <input type="text" id="editRoleName" name="role_name" class="form-control" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Save Changes</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelectorAll('.editBtn').forEach(btn => {
    btn.addEventListener('click', function () {

        let id = this.dataset.id;
        let name = this.dataset.name;

        document.getElementById('editRoleName').value = name;

        document.getElementById('editRoleForm').action =
            "{{ url('/hr/roles/update') }}/" + id;
    });
});
</script>

</body>
</html>
