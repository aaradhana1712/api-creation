<!-- Sidebar Navigation-->
<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar">
            <img src="{{ asset('Admin_Template-main/img/avatar-6.jpg') }}" alt="..." class="img-fluid rounded-circle">
        </div>
        <div class="title">
            <h1 class="h5">{{ auth()->user()->name ?? 'Mark Stephen' }}</h1>
            <p>{{ auth()->user()->role ?? 'Web Designer' }}</p>
        </div>
    </div>
    
    <!-- Sidebar Navigation Menus-->
    <span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}"> 
                <i class="icon-home"></i>Dashboard 
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}"> 
                <i class="icon-user-1"></i>Users 
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <a href="#"> 
                <i class="icon-grid"></i>Products 
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <a href="#"> 
                <i class="icon-contract"></i>Orders 
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <a href="#"> 
                <i class="fa fa-bar-chart"></i>Reports 
            </a>
        </li>
        <li class="{{ request()->routeIs('admin.forms.*') ? 'active' : '' }}">
            <a href="#"> 
                <i class="icon-padnote"></i>Forms 
            </a>
        </li>
        
        <!-- Example dropdown -->
        <li>
            <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> 
                <i class="icon-windows"></i>Example dropdown 
            </a>
            <ul id="exampledropdownDropdown" class="collapse list-unstyled">
                <li><a href="#">Submenu 1</a></li>
                <li><a href="#">Submenu 2</a></li>
                <li><a href="#">Submenu 3</a></li>
            </ul>
        </li>
        <li class="{{ request()->routeIs('admin.login') ? 'active' : '' }}">
            <a href="{{ route('admin.login') }}"> 
                <i class="icon-logout"></i>Login page
            </a>
        </li>
    </ul>
    
    <span class="heading">Settings</span>
    <ul class="list-unstyled">
        <li class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"> 
            <a href="#"> 
                <i class="icon-settings"></i>Settings 
            </a>
        </li>
        <li> 
            <a href="#"> 
                <i class="icon-writing-whiteboard"></i>Configuration 
            </a>
        </li>
        <li> 
            <a href="#"> 
                <i class="icon-chart"></i>Analytics 
            </a>
        </li>
        <li> 
            <a href="#"> 
                <i class="fa fa-cog"></i>System Info 
            </a>
        </li>
    </ul>
    
    <span class="heading">Account</span>
    <ul class="list-unstyled">
        <li> 
            <a href="#"> 
                <i class="fa fa-user"></i>Profile 
            </a>
        </li>
        <li> 
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();"> 
                <i class="icon-logout"></i>Logout 
            </a>
        </li>
    </ul>
    
    <form id="logout-form-sidebar" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</nav>