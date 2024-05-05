<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register to Danch0u</title>
    <link href="assets/css/auth.css" rel="stylesheet" />
</head>

<body>
    <div class="register">
        <div class="reg-header">
            <h1>Sign Up</h1>
            <p>Create New Account</p>
        </div>
        <div class="reg-form">
            <div>
                <h3>Username</h3>
                <input type="text" id="reg-username" name="username" placeholder="user123">
            </div>
            <div>
                <h3>Email</h3>
                <input type="text" id="reg-email" name="email" placeholder="user123@example.com">
            </div>
            <div>
                <h3>Password</h3>
                <input type="password" id="reg-password" name="password" placeholder="Strong Password">
            </div>
            <div>
                <h3>Confirm Password</h3>
                <input type="password" id="reg-pass-confirm" name="password_confirmation" placeholder="Confirm Password">
            </div>
        </div>
        <div class="reg-actions">
            <div class="reg-btn">
                <h3>Register</h3>
            </div>
            <div class="reg-redirect">
                <a href="{{ route('login') }}">Already Have an Account?</a>
            </div>
        </div>
    </div>

    <script src="assets/js/register.js"></script>
</body>

</html>