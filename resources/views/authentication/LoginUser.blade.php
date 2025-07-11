<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
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

            #btnLogin {
                background-color: #212529;
                color: #ffffff;
                font-size: 14px;
                letter-spacing: .5px;
                border-radius: 0px;
                border: 1px solid #dee2e6;
                width: 100%;
                padding: 10px 40px;
                margin: 0px;
                margin-top: 16px;

                &:hover {
                    background-color: #343a40;
                    color: #fff;
                    cursor: pointer;
                }

                &:active {
                    background-color: #212529;
                    transform: translateY(2px);
                }

                &:disabled {
                    background-color: #8c8f92;
                    cursor: not-allowed;
                    border: 1px solid #dee2e6;
                }
            }

            .form-group {
                margin-bottom: 16px;
                padding: 0px;
                position: relative;

                .input-icon {
                    position: absolute;
                    top: 59%;
                    left: 13px;
                    font-size: 16px;
                    color: #8c8f92;
                }

                label {
                    font-size: 14px;
                    letter-spacing: .5px;
                    text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                    margin-bottom: 5px;
                }

                a {
                    text-decoration-line: none;
                    font-size: 14px;
                    letter-spacing: .5px;
                    text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                    margin-bottom: 5px;

                    &:hover {
                        text-decoration-line: underline;
                        font-size: 14px;
                        letter-spacing: .5px;
                        text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                        margin-bottom: 5px;
                    }
                }

                input {
                    color: #1f2328;
                    font-size: 14px;
                    letter-spacing: .5px;
                    border-radius: 0px;
                    border: 1px solid #dee2e6;
                    padding: 10px 40px;
                    box-shadow: 0px 0px 1px rgba(23, 32, 42, 0.3);

                    &::placeholder {
                        font-size: 14px;
                        letter-spacing: .5px;
                        text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                        color: #8c8f92;
                    }

                    &:focus {
                        border-color: #212529;
                        font-size: 14px;
                        letter-spacing: .5px;
                        color: #1f2328;
                        outline: none;
                    }
                }

                .toggle-password {
                    position: absolute;
                    right: 10px;
                    top: 50%;
                    transform: translateY(15%);
                    background: none;
                    border: none;
                    cursor: pointer;
                    font-size: 14px;
                    color: #8c8f92;
                }
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

            <div class="form-group">
                <i class="fa-solid fa-envelope input-icon"></i>
                <label for="user_name">Username</label>
                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Username" required>
            </div>
         
            <div class="form-group">
                <i class="fa-solid fa-lock input-icon"></i>
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <i class="fa-solid fa-eye"></i>
                </button>
            </div>

            @error('ErrorMessage')
                <div class="alert alert-danger error-message">{{ $message }}</div>
            @enderror

            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <button type="submit" class="btnLogin" id="btnLogin">Login</button>
            </div>

            <div class="form-group" style="text-align: center;" >
                <label for="">Don't have an account? <a href="{{ url('/register') }}">Register now</a></label>
            </div>
        </div>
    </form>
</body>
</html>

<script>
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const toggleButton = document.querySelector(".toggle-password i");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleButton.classList.remove("fa-eye");
            toggleButton.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleButton.classList.remove("fa-eye-slash");
            toggleButton.classList.add("fa-eye");
        }
    }
</script>
