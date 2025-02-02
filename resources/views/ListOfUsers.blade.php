<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('components.css')
</head>
<body>
    @include('components.header')

    <main>
        <div class="col-md-12 main-content">
            <div class="col-md-12 content-header">
                <h3>List of Users</h3>
                <button type="button" class="btn btn-primary btnHeader" id="btnAddUser">Add User</button>
            </div>
            <div class="col-md-12 content-body">
                <table class="table table-hover table-bordered" id="userListTable">
                    <thead>
                        <tr>
                            <th class="text-left" style="width: 15%; text-align: left;">UserNo.</th>
                            <th class="text-left" style="width: 20%;">Username</th>
                            <th class="text-left" style="width: 30%;">Fullname</th>
                            <th class="text-left" style="width: 20%;">Status</th>
                            <th class="text-center" style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="loadUsers"></tbody>
                </table>               
            </div>
        </div>
    </main>

    <!-- Create user modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="col-md-12 modal-body" style="max-height: 60vh; overflow-y: auto;">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="addFirstName">First Name:</label>
                            <input type="text" class="form-control" id="addFirstName">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="addLastName">Last Name:   </label>
                            <input type="text" class="form-control" id="addLastName">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="addUserName">Email:</label>
                            <input type="text" class="form-control" id="addUserName">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btnSubmitCreateUser" onclick="CreateNewUser()">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Remove user modal -->
    <div class="modal fade" id="removeUserModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 400px; width: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Action Verification</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="col-md-12 modal-body">
                    <div class="col-md-12 mb-3 p-0">
                        <label>Are you sure you want to remove this user?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btnClose" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btnConfirmRemoveUser">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
</body>
</html>
<script>
    document.getElementById('btnAddUser').addEventListener('click', function() {
        var myModal = new bootstrap.Modal(document.getElementById('createUserModal'));
        myModal.show();
    });

    function LoadListOfUsers() {
        $.ajax({
            url: '/GetActiveUsers',
            method: 'GET',
            success: function(users) {
                if ($.fn.DataTable.isDataTable('#userListTable')) {
                    $('#userListTable').DataTable().destroy();
                }

                $('#loadUsers').empty();

                users.forEach(function(row, index) {
                    if (row.user_status === 1) { 
                        $('#loadUsers').append(`
                            <tr>
                                <td style="vertical-align: middle; text-align: left;">${row.UserID}</td>
                                <td style="vertical-align: middle;">${row.user_name}</td>
                                <td style="vertical-align: middle;">${row.first_name} ${row.last_name}</td>    
                                <td style="vertical-align: middle;">${row.user_status === 1 ? 'Active' : 'Inactive'}</td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <button class="btn btn-transparent" id="btnShowUser${row.UserID}" onclick="ShowUserModal(${row.UserID}, 'Show')"><span class="fas fa-eye"></span></button>
                                    <button class="btn btn-transparent" id="btnEditUser${row.UserID}" onclick="ShowUserModal(${row.UserID}, 'Edit')"><span class="fas fa-pencil"></span></button>
                                    <button class="btn btn-transparent" id="btnRemoveUser${row.UserID}" onclick="ShowRemoveUserModal(${row.UserID})"><span class="fas fa-trash"></span></button>
                                </td>
                            </tr>
                        `);
                    }
                });

                $('#userListTable').DataTable({
                    searching: true,
                    pageLength: 7,
                    lengthChange: false,
                    ordering: true,
                    columnDefs: [
                        { type: 'num', targets: 0 }
                    ]
                });
            },
            error: function() {
                console.error('Error fetching users.');
            }
        });
    }

    function ShowRemoveUserModal(UserID) {
        const removeUserButton = document.getElementById('btnRemoveUser' + UserID);
        const confirmRemoveButton = document.getElementById('btnConfirmRemoveUser');
        const modal = new bootstrap.Modal(document.getElementById('removeUserModal'));

        modal.show();

        confirmRemoveButton.setAttribute('onclick', `RemoveUser(${UserID})`);
    }

    function CreateNewUser() {
        const firstName = document.getElementById('addFirstName').value;
        const lastName = document.getElementById('addLastName').value;
        const userName = document.getElementById('addUserName').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        $.ajax({
            url: `/info`,
            method: 'POST',
            data: {
                first_name: firstName,
                last_name: lastName,
                user_name: userName
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                console.log('User created successfully', response);
            },
            error: function(error) {
                console.log('Error creating user', error);
            }
        });
    }

    function RemoveUser(UserID) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $.ajax({
            url: `/user/${UserID}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                console.log('User status updated successfully', response);
            },
            error: function(error) {
                console.error('Error updating user status', error);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        LoadListOfUsers();
    });
</script>
