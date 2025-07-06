<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
    body {
        background-color: #f6f6f6;
        position: relative;
        height: 100vh;
        padding: 0px;
        margin: 0px;
    }

    form {
        background-color: #ffffff;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0px 0px 3px #00000025;
        border: 1px solid #d1d1d1;
        width: 420px;

        .form-header {
            display: grid;
            place-items: center;
            padding: 30px;
            margin: 0px;

            h4 {
                text-decoration: none; 
                color: #1f2328;
                font-size: 1.5rem;
                font-weight: 600;
                letter-spacing: .5px;
                padding: 0px;
                margin: 0px;
                display: flex;
                align-items: center;
            }
        }

        .form-body {
            padding: 0px 30px 30px 30px;
            margin: 0px;

            h5 {
                text-decoration: none;
                color: #1f2328;
                font-size: 1.2rem;
                font-weight: 600;
                letter-spacing: .5px;
            }
        }
    }
</style>

<body>
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="form-header">
            <h4 class="form-title">Event Manager</h4>
        </div>

        <div class="form-body">
            <h5>Login</h5>

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
