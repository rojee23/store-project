<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Status</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>

<body>

<div class="shape"></div><div class="shape"></div><div class="shape"></div><div class="shape"></div>

<div class="login-container">
    <div class="login-card">

        <div class="card-header">
            <div class="header-icon"><i class="fas fa-user-check"></i></div>
            <h2>Employee Status</h2>
            <p>Manage Employee Status Types</p>
        </div>

        <div class="card-body">

            <div class="mb-3">
                <a href="{{ route('hr.dashboard') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            <button class="btn-login mb-3 w-100" data-bs-toggle="modal" data-bs-target="#addStatusModal">
                <span>Add New Status</span>
                <i class="fas fa-plus"></i>
            </button>

            <div class="table-responsive">
                <table class="table table-bordered text-center bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Status Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($statuses as $status)
                            <tr>
                                <td>{{ $status->employee_status_id }}</td>
                                <td>{{ $status->status }}</td>

                                <td>

                                    <!-- EDIT BUTTON (same as Roles) -->
                                    <button class="btn-action-sm btn-edit editBtn"
                                            data-id="{{ $status->employee_status_id }}"
                                            data-name="{{ $status->status }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editStatusModal">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- DELETE BUTTON (same as Roles) -->
                                    <a href="/hr/status/delete/{{ $status->employee_status_id }}"
                                       class="btn-action-sm btn-delete"
                                       onclick="return confirm('Are you sure you want to delete this status?')">
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

<!-- ADD STATUS MODAL -->
<div class="modal fade" id="addStatusModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Add New Status</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="/hr/status/store" method="POST">
                @csrf

                <div class="modal-body">
                    <label class="form-label">Status Name</label>
                    <input type="text" name="status_name" class="form-control" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Add Status</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- EDIT STATUS MODAL -->
<div class="modal fade" id="editStatusModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Edit Status</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editStatusForm" method="POST">
                @csrf

                <div class="modal-body">
                    <label class="form-label">Status Name</label>
                    <input type="text" id="editStatusName" name="status_name" class="form-control" required>
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

        document.getElementById('editStatusName').value = name;

        document.getElementById('editStatusForm').action =
            `/hr/status/update/${id}`;
    });
});
</script>

</body>
</html>
