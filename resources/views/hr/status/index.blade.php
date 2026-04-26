<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Status</title>

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
                <i class="fas fa-user-check"></i>
            </div>
            <h2>Employee Status</h2>
            <p>Manage Employee Status Types</p>
        </div>

        <div class="card-body">

            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('hr.dashboard') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            <!-- Add Status Button -->
            <button class="btn-login mb-3 w-100" data-bs-toggle="modal" data-bs-target="#addStatusModal">
                <span>Add New Status</span>
                <i class="fas fa-plus"></i>
            </button>

            <!-- Status Table -->
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
                                <!-- FIXED: use employee_status_id -->
                                <td>{{ $status->employee_status_id }}</td>

                                <!-- FIXED: use status -->
                                <td>{{ $status->status }}</td>

                                <td>
                                    <!-- Edit -->
                                    <button class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editStatusModal{{ $status->employee_status_id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Delete -->
                                    <a href="/hr/status/delete/{{ $status->employee_status_id }}"
                                       class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editStatusModal{{ $status->employee_status_id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5>Edit Status</h5>
                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="/hr/status/update/{{ $status->employee_status_id }}" method="POST">
                                            @csrf

                                            <div class="modal-body">
                                                <label class="form-label">Status Name</label>

                                                <!-- FIXED: use value="{{ $status->status }}" -->
                                                <input type="text" name="status_name"
                                                       class="form-control"
                                                       value="{{ $status->status }}" required>
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

<!-- Add Status Modal -->
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

                    <!-- FIXED: name="status_name" is correct -->
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
