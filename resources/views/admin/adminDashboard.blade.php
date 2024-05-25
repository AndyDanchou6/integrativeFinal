@extends('layouts.adminLayout')

@section('title', 'Admin Dashboard')

@section('content')

<div class="page-header">
    <div>
        <h1>Dashboard</h1>
        <p>
            <a href="">Home /</a>
            <span class="active">Dashboard</span>
        </p>
    </div>
</div>
<div class="table">
    <div class="container">
        <h1>List of Users</h1>
        <button class="bg-success" onclick="addUser()">
            <p>Add User</p>
        </button>
    </div>
    <div id="table-wrap">
        <table>
            <thead id="column-name">

            </thead>
            <tbody id="data-fields">

            </tbody>
        </table>
    </div>
</div>

<!-- Add User Pop up Form -->
<div class="popUpForm">
    <div id="form-header">
        <h1 class="color-dark">Add User</h1>
        <button id="close-form">X</button>
    </div>
    <form id="submit_form" class="column">
        <div id="form-fields" class="column">
            <div class="input-field">
                <h3 class="color-dark">Username :</h3>
                <input type="text" id="username" name="username">
            </div>
            <div class="input-field">
                <h3 class="color-dark">Email :</h3>
                <input type="email" id="email" name="email">
            </div>
            <div class="input-field">
                <h3 class="color-dark">Password :</h3>
                <input type="password" id="password" name="password">
            </div>
            <div class="input-field">
                <h3 class="color-dark">Confirm Password :</h3>
                <input type="password" id="confirm-password" name="password_confirmation">
            </div>
            <div class="input-field">
                <h3 class="color-dark">Phone Number :</h3>
                <input type="text" id="phoneNo" name="phoneNo">
            </div>
            <div class="input-field">
                <h3 class="color-dark">Profile Picture :</h3>
                <input type="file" id="image" name="image">
            </div>
            <button type="submit" class="bg-success">
                <p>Submit</p>
            </button>
        </div>
    </form>
</div>

@endsection

@section('script')
<script src="assets/js/adminDashboard.js"></script>
@endsection