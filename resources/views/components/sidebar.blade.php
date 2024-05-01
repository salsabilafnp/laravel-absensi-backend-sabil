<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home')}}">ePresence</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home')}}">eP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item">
                <a href="{{ route('home')}}" class="nav-link">
                    <i class="fas fa-solid fa-desktop"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="fas fa-solid fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('companies.index') }}" class="nav-link">
                    <i class="fas fa-solid fa-building"></i>
                    <span>Companies</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('attendances.index') }}" class="nav-link">
                    <i class="fas fa-solid fa-clipboard-user"></i>
                    <span>Attendances</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('permissions.index') }}" class="nav-link">
                    <i class="fas fa-regular fa-envelope"></i>
                    <span>Permission</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
