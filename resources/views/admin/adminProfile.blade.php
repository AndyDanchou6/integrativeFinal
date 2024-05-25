@extends('layouts.adminLayout')

@section('title', 'Admin Profile')

@section('content')
<div class="page-header">
    <div>
        <h1>Dashboard</h1>
        <p>
            <a href="">Home /</a>
            <span class="active">Profile</span>
        </p>
    </div>
</div>

<div class="page-content" id="profile-content">
    <div id="profile-pic-container">
        <div class="profile-pic-wrap column centered">
            <img src="assets/img/bg2.jpg" alt="">
            <button>Edit</button>
        </div>
    </div>
    <div id="profile-details" class="column">
        <div class="card-header">
            <h2>User Profile</h2>
        </div>
        <div class="card-content column">
            <div id="profile-username">
                <h3>Username : </h3>
            </div>
            <div id="profile-email">
                <h3>Email : </h3>
            </div>
            <div id="profile-phoneNo">
                <h3>Phone Number : </h3>
            </div>
            <div id="profile-role">
                <h3>Role : </h3>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="assets/js/adminProfile.js"></script>
@endsection