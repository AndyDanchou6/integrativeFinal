@extends('layouts.authLayout')

@section('title', 'Verify')

@section('initialScript')
<script>
    const email = localStorage.getItem('danchouEmail');

    if (!email) {
        window.location.href = '/';
    }
</script>
@endsection

@section('content')
<div class="otp-verify">
    <h2>OTP Verification</h2>
    <p>Type the OTP code sent to your mobile device</p>
    <input type="text" id="otp-code">
    <button id="submit-btn">
        <p>Submit</p>
    </button>
    <a id="resend-code">Resend Code</a>
</div>
@endsection

@section('script')
<script src="assets/js/verifyOtp.js"></script>
@endsection