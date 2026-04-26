<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employees List</title>

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
                <i class="fas fa-list"></i>
            </div>
            <h2>Employees List</h2>
            <p>View & Manage Employees</p>
        </div>

        <div class="card-body">

            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('hr.dashboard') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            <!-- Filters -->
            <div class="mb-4">
                <h5 class="mb-3">Search Filters</h5>

                <div class="row">

                    <div class="col-md-3 mb-2">
                        <input type="text" id="filterName" class="form-control" placeholder="Search by name">
                    </div>

                    <div class="col-md-3 mb-2">
                        <select id="filterDepartment" class="form-select">
                            <option value="">Department</option>
                            @foreach($departments as $d)
                                <option value="{{ $d->department_id }}">{{ $d->department_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-2">
                        <select id="filterRole" class="form-select">
                            <option value="">Role</option>
                            @foreach($roles as $r)
                                <option value="{{ $r->role_id }}">{{ $r->type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-2">
                        <select id="filterStatus" class="form-select">
                            <option value="">Status</option>
                            @foreach($statuses as $s)
                                <option value="{{ $s->employee_status_id }}">{{ $s->status }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <button class="btn-login mt-2" id="searchBtn">
                    <span>Search</span>
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <!-- Employees Table -->
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="employeesTable">
                        @foreach($employees as $emp)
                            <tr>
                                <td>{{ $emp->personal_id }}</td>

                                <td>
                                    @if($emp->upload_file)
                                        <img src="{{ asset('uploads/employees/' . $emp->upload_file) }}" width="50" height="50" class="rounded-circle">
                                    @else
                                        <i class="fas fa-user-circle fa-2x"></i>
                                    @endif
                                </td>

                                <td>{{ $emp->firstName }} {{ $emp->lastName }}</td>
                                <td>{{ $emp->department->department_name ?? '-' }}</td>
                                <td>{{ $emp->role->type ?? '-' }}</td>
                                <td>{{ $emp->employeeStatus->status ?? '-' }}</td>

                                <td>
                                    <a href="{{ route('hr.employee.show', $emp->personal_id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('hr.employee.edit', $emp->personal_id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="{{ route('hr.employee.delete', $emp->personal_id) }}" class="btn btn-sm btn-danger">
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

<!-- AJAX Script -->
<script>
document.getElementById('searchBtn').addEventListener('click', function () {

    let name = document.getElementById('filterName').value;
    let dep = document.getElementById('filterDepartment').value;
    let role = document.getElementById('filterRole').value;
    let status = document.getElementById('filterStatus').value;

    fetch(`/hr/employee/search/api?firstName=${name}&department_id=${dep}&role_id=${role}&employee_status_id=${status}`)
        .then(res => res.json())
        .then(data => {

            let table = document.getElementById('employeesTable');
            table.innerHTML = "";

            data.forEach(emp => {
                table.innerHTML += `
                    <tr>
                        <td>${emp.personal_id}</td>
                        <td><i class="fas fa-user-circle fa-2x"></i></td>
                        <td>${emp.firstName} ${emp.lastName}</td>
                        <td>${emp.department_id ?? '-'}</td>
                        <td>${emp.role_id ?? '-'}</td>
                        <td>${emp.employee_status_id ?? '-'}</td>
                        <td>
                            <a href="/hr/employee/show/${emp.personal_id}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="/hr/employee/edit/${emp.personal_id}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <a href="/hr/employee/delete/${emp.personal_id}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                `;
            });

        });

});
</script>

</body>
</html>
