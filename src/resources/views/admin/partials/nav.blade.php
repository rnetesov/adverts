<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.home') ? 'active' : ''}}" href="{{ route('admin.home') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : ''}}" href="{{ route('admin.users.index') }}">Users</a>
    </li>
    <li>
        <a class="nav-link {{ request()->routeIs('admin.regions.*') ? 'active' : ''}}" href="{{ route('admin.regions.index') }}">Regions</a>
    </li>
</ul>
