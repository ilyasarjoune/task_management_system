<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <style>
        /* Sidebar styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px; /* Sidebar initially hidden */
            width: 250px;
            height: 100vh; /* Full height */
            background-color: #343a40; /* Dark background color */
            transition: left 0.3s; /* Smooth transition */
            z-index: 1000; /* Ensure sidebar appears above other content */
        }
        .sidebar:hover {
            left: 0; /* Sidebar appears when hovered over */
        }
        .sidebar-content {
            padding: 20px;
            color: #fff; /* Text color */
        }
        /* Green button style */
        .btn-green {
            background-color: #28a745; /* Green color */
            border-color: #28a745; /* Green border color */
        }
        .btn-green:hover {
            background-color: #218838; /* Darker green color on hover */
            border-color: #1e7e34; /* Darker green border color on hover */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Task Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            
        </div>
    </div>
</nav>

<div class="container">
    <h1>Tasks</h1>
    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#addTaskModal">Add New Task</button>
    
    <!-- Table to display tasks -->   
    <table class="table" id="tasks-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Start Date</th>
                <th>Expected End Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Assignment</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Task rows will be populated here by DataTables -->
        </tbody>
    </table>
</div>

<!-- Modal for adding a new task -->  
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to add new task -->
                <form action="{{ route('task.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="statu_id" class="form-select" id="status" required>
                            @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="date" name="startDate" class="form-control" id="startDate">
                    </div>
                    <div class="mb-3">
                        <label for="expectedEndDate" class="form-label">Expected End Date</label>
                        <input type="date" name="expectedEndDate" class="form-control" id="expectedEndDate">
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" name="endDate" class="form-control" id="endDate">
                    </div>
                    <div class="mb-3">
                        <label for="cat" class="form-label">Category</label>
                        <select name="categorie_id" class="form-select" id="cat" required>
                            @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </form>
                
            </div>
        </div>
    </div>
</div>


<!-- Modal for editing a task -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to edit task -->
                <form id="editTaskForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="taskId" id="editTaskId">
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="editTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="editDescription"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select name="statu_id" class="form-select" id="editStatus" required>
                            @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editStartDate" class="form-label">Start Date</label>
                        <input type="date" name="startDate" class="form-control" id="editStartDate">
                    </div>
                    <div class="mb-3">
                        <label for="editExpectedEndDate" class="form-label">Expected End Date</label>
                        <input type="date" name="expectedEndDate" class="form-control" id="editExpectedEndDate">
                    </div>
                    <div class="mb-3">
                        <label for="editEndDate" class="form-label">End Date</label>
                        <input type="date" name="endDate" class="form-control" id="editEndDate">
                    </div>
                    <div class="mb-3">
                        <label for="editCategory" class="form-label">Category</label>
                        <select name="categorie_id" class="form-select" id="editCategory" required>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Task</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
 $(document).ready(function() {
        $('#tasks-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('tasks.getTasks') }}',
            columns: [
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'category', name: 'category' },
                { data: 'startDate', name: 'startDate' },
                { data: 'expectedEndDate', name: 'expectedEndDate' },
                { data: 'endDate', name: 'endDate' },
                { data: 'status', name: 'status' },
                {
                    data: 'assignment', 
                    render: function(data, type, row) {
                        var users = @json($users);
                        var options = '';
                        users.forEach(function(user) {
                            options += `<option value="${user.id}">${user.name}</option>`;
                        });
                        return `<select class="form-select" onchange="assignUser(${row.id}, this.value)">
                                    <option value="">Assign User</option>
                                    ${options}
                                </select>`;
                    },
                    orderable: false,
                    searchable: false
                },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });

    function assignUser(taskId, userId) {
        $.ajax({
            url: `/task/${taskId}/assign`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: userId
            },
            success: function(response) {
                alert('User assigned successfully!');
            }
        });
    }
        





    window.editTask = function(taskId) {
        $.ajax({
            url: '/task/' + taskId + '/edit',
            method: 'GET',
            success: function(data) {
                $('#editTaskId').val(data.id);
                $('#editTitle').val(data.title);
                $('#editDescription').val(data.description);
                $('#editStatus').val(data.statu_id);
                $('#editStartDate').val(data.startDate);
                $('#editExpectedEndDate').val(data.expectedEndDate);
                $('#editEndDate').val(data.endDate);
                $('#editCategory').val(data.categorie_id);
                $('#editTaskModal').modal('show');
            }
        });
    }

    // Handle edit task form submission
    $('#editTaskForm').submit(function(event) {
        event.preventDefault();

        var taskId = $('#editTaskId').val();
        var formData = $(this).serialize();

        $.ajax({
            url: '/task/' + taskId,
            method: 'PUT',
            data: formData,
            success: function(response) {
                $('#editTaskModal').modal('hide'); // Hide the modal on success
                table.ajax.reload(null, false); // Reload DataTables without resetting pagination
                alert('Task updated successfully!');
            },
            error: function(response) {
                    $('#editTaskModal').modal('hide'); // Hide the modal on success
                    location.reload();// Reload DataTables without resetting pagination
            }
        });
    });

    
</script>

</body>
</html>
