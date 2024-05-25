@extends('layouts.authLayout')

@section('title', 'Log In')

@section('content')
<!-- @if(Session::has('unauthorized'))
<div class="unauthorized">
    <h3 class="warning">Warning! Unauthorized Access.</h3>
</div>
@endif -->
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

@endsection

@section('script')
<script src="assets/js/login.js"></script>
@endsection