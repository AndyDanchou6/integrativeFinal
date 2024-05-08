<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login to Danch0u</title>
    <link href="assets/css/auth.css" rel="stylesheet" />
</head>

<body>
    <div class="login">
        <div class="log-header">
            <h1>Login</h1>
            <p>Please Insert Valid Credentials</p>
        </div>
        <div class="log-form">
            <div>
                <h3>Email</h3>
                <input type="text" id="login-email" name="email" placeholder="someone@example.com">
            </div>
            <div>
                <h3>Password</h3>
                <input type="password" id="login-password" name="password" placeholder="Your password">
            </div>
        </div>
        <div class="log-action">
            <div class="loginBtn">
                <h3>Login</h3>
            </div>
            <div class="log-redirect">
                <a href="{{ route('register') }}">Create New Account</a>
                <!-- <a href="">Forgot Password?</a> -->
            </div>
        </div>
    </div>

    <script src="assets/js/login.js"></script>
</body>

</html>