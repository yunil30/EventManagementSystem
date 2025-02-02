<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    @include('components.css')
</head>
<body>
    @include('components.header')

    <content>
    </content>

    <main>
        <div class="col-md-12 main-content">
            <div class="col-md-12 content-header">
                <h3>Create New User</h3>
                <button class="btn">Add</button>
            </div>
            <div class="col-md-12 content-body">
                <!-- Display success or error message -->
                <div id="message"></div>
            
                <!-- The form to submit new user data -->
                <form id="createUserForm">
                    @csrf <!-- CSRF token for security -->
                    
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" id="first_name" required><br>
            
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" id="last_name" required><br>
            
                    <label for="user_name">User Name:</label>
                    <input type="text" name="user_name" id="user_name" required><br>
            
                    <button type="submit">Save User</button>
                </form>
            </div>
        </div>
    </main>

    @include('components.footer')
</body>
</html>
<script>
    // Select the form element
    const form = document.getElementById('createUserForm');
    const messageDiv = document.getElementById('message');
    
    // Intercept the form submission
    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Get form data
        const formData = new FormData(form);

        // Send data using Axios
        axios.post('{{ url("/info") }}', formData)
        // axios.post('{{ route("info.create") }}', formData)
            .then(response => {
                // Handle success
                messageDiv.innerHTML = `<p style="color: green;">${response.data.message}</p>`;
                form.reset(); // Optionally reset the form
            })
            .catch(error => {
                // Handle error
                if (error.response && error.response.data) {
                    let errors = error.response.data.errors;
                    let errorMessages = '';
                    for (let key in errors) {
                        errorMessages += `<p style="color: red;">${errors[key][0]}</p>`;
                    }
                    messageDiv.innerHTML = errorMessages;
                }
            });
    });
</script>
