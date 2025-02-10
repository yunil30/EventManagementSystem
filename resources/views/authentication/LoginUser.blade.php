<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
    body {
        height: 100vh;
        margin-bottom: 1rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    form {
        box-shadow: 0px 0px 3px #00000047;
        border: 1px solid rgb(215, 215, 215);
        width: 350px;
        height: 400px; 
        padding: 2rem;
    }
</style>
<body>
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="col-md-12">
            <h3>Login</h3>
        </div>

        <div class="col-md-12">
            <label for="user_name">Username</label><br>
            <input type="text" name="user_name" id="user_name" required>
        </div>

        <div class="col-md-12">
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="col-md-12">
            <button type="submit">Login</button>
        </div>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</body>
</html>
