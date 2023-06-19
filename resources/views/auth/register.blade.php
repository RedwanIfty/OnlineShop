<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .error {
            color: red;
        }

        body {
            background-image: url('/home/images/banner-bg.png');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .login-card {
            margin: 0 auto;
            max-width: 400px;
            margin-top: 100px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .login-card-header {
            background-color: transparent;
            padding: 30px;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .login-card-title {
            margin-bottom: 0;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .login-card-body {
            padding: 30px;
            background-color: transparent;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 10px;
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
            border-color: #007bff;
        }

        .login-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
        }

        .login-btn:hover {
            background-color: #0069d9;
        }

        .forgot-password-link,
        .signup-link {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="card login-card">
        <div class="card-header login-card-header">
            <h1 class="card-title login-card-title">Register</h1>
        </div>
        <div class="card-body login-card-body">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control"
                           placeholder="Enter your name">
                    @error('name')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="Enter your email or username">
                    @error('email')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="Enter your password">
                    @error('password')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                           placeholder="Enter your password">
                    @error('password_confirmation')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="login-btn">Register</button>
            </form>
            <p class="text-center mt-3">
                <a href="{{route('login')}}" class="forgot-password-link">Already Register?</a>
            </p>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
