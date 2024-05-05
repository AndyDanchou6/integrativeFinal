@extends('layouts.adminLayout')

@section('title', 'Admin Dashboard')

@section('content')

<div class="page-header">
    <h1>Dashboard</h1>
    <p>
        <a href="">Home /</a>
        <span class="active">Dashboard</span>
    </p>
</div>
<div class="table">
    <h1>List of Users</h1>
    <div id="table-wrap">
        <table>
            <thead id="column-name">

            </thead>
            <tbody id="data-fields">

            </tbody>
        </table>
    </div>
</div>

@endsection