<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        /* Define your email styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to Danchou!</h1>
        <p>Hi {{ $username }},</p>
        <p>Here are your login details:</p>
        <ul>
            <li><strong>Email:</strong> {{ $email }}</li>
            <li><strong>Password:</strong> {{ $password }}</li>
        </ul>
        <p>We're excited to have you on board. Log in now and start exploring!</p>
        <a href="#" class="button">Login Now</a>
        <p>If you have any questions or need assistance, feel free to contact us.</p>
        <p>Best Regards,<br> Danchou</p>
    </div>
</body>

</html>