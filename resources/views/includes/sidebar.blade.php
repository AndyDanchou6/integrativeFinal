<section class="column" id="sidebar">
    <ul>
        <li><a href="{{ route('admin.dashboard') }}" class="dashboard-btn">Dashboard</a></li>
        <li><a href="{{ route('admin.profile') }}">Profile</a></li>
        <li><a href="#">Chat</a></li>
        <li onclick="logout()"><a class="logout-btn">Logout</a></li>
    </ul>
</section>