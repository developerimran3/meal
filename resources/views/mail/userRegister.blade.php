<!DOCTYPE html>
<html>

<head>
    <style>
        .container {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 10px;
        }

        .box {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
        }

        h2 {
            color: #333;
        }

        p {
            font-size: 16px;
            color: #444;
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
                <li>Username: {{ $user->username }}</li>
                <li>Email: {{ $user->email }}</li>
                <li>Post: {{ $user->role }}</li>
                <li>Password: {{ $password }}</li>
            </ul>

            <p>Please login and change your password.</p>

            <br>
            <p>Regards,<br>Meal Management System</p>

        </div>
    </div>
</body>

</html>
