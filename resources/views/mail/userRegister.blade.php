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
            <h2>{{ $subjectText }}</h2>
            <p>{{ $bodyText }}</p>

            <br>

            <p>Regards,<br>Your App Team</p>
        </div>
    </div>
</body>

</html>
