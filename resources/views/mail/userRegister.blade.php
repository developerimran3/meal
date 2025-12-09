<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Account Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        .container {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
        }

        .box {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #e0e0e0;
        }

        h2 {
            color: #333;
            margin-bottom: 15px;
        }

        p {
            font-size: 15px;
            color: #444;
            line-height: 1.6;
        }

        ul {
            padding-left: 20px;
            margin-top: 10px;
        }

        li {
            margin-bottom: 6px;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            background: #3b82f6;
            color: white !important;
            text-decoration: none;
            border-radius: 6px;
            margin: 15px 0;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="box">
            <h2>Hello {{ $user->name }},</h2>

            <p>Your account has been created successfully!</p>

            <p><strong>Login Information:</strong></p>

            <ul>
                <li><strong>Username:</strong> {{ $user->username }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Password:</strong> {{ $password }}</li>
            </ul>

            <p>Please login to your account and change your password immediately for security.</p>

            <a class="btn" href="{{ route('login') }}">Login to Your Account</a>

            <p>Regards,<br>Meal Management System</p>
        </div>
    </div>
</body>

</html>
