<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    @if(session('error'))
        <div style="color:red;">{{ session('error') }}</div>
    @endif

    <form action="{{ url('login') }}" method="POST">
        @csrf
        <div>
            <label for="user_email">Email:</label>
            <input type="text" name="user_email" id="user_email" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>

</body>
</html>
