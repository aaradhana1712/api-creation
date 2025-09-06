<header class="header">   
    <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
            <div class="search-inner d-flex align-items-center justify-content-center">
                <div class="close-btn">Close <i class="fa fa-close"></i></div>
                <form id="searchForm" action="#">
                    <div class="form-group">
                        <input type="search" name="search" placeholder="What are you searching for...">
                        <button type="submit" class="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="navbar-header">
                <!-- Navbar Header-->
                <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
                    <div class="brand-text brand-big visible text-uppercase">
                        <strong class="text-primary">Dark</strong><strong>Admin</strong>
                    </div>
                    <div class="brand-text brand-sm">
                        <strong class="text-primary">D</strong><strong>A</strong>
                    </div>
                </a>
                <!-- Sidebar Toggle Btn-->
                <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
            </div>
            <div class="right-menu list-inline no-margin-bottom">    
                <div class="list-inline-item">
                    <a href="#" class="search-open nav-link">
                        <i class="icon-magnifying-glass-browser"></i>
                    </a>
                </div>
                
                <!-- Messages Dropdown -->
                <div class="list-inline-item dropdown">
                    <a id="navbarDropdownMenuLink1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link messages-toggle">
                        <i class="icon-email"></i>
                        <span class="badge dashbg-1">5</span>
                    </a>
                    <div aria-labelledby="navbarDropdownMenuLink1" class="dropdown-menu messages">
                        <a href="#" class="dropdown-item message d-flex align-items-center">
                            <div class="profile">
                                <img src="{{ asset('Admin_Template-main/img/avatar-3.jpg') }}" alt="..." class="img-fluid">
                                <div class="status online"></div>
                            </div>
                            <div class="content">   
                                <strong class="d-block">Nadia Halsey</strong>
                                <span class="d-block">lorem ipsum dolor sit amit</span>
                                <small class="date d-block">9:30am</small>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item message d-flex align-items-center">
                            <div class="profile">
                                <img src="{{ asset('Admin_Template-main/img/avatar-2.jpg') }}" alt="..." class="img-fluid">
                                <div class="status away"></div>
                            </div>
                            <div class="content">   
                                <strong class="d-block">Peter Ramsy</strong>
                                <span class="d-block">lorem ipsum dolor sit amit</span>
                                <small class="date d-block">7:40am</small>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item text-center message"> 
                            <strong>See All Messages <i class="fa fa-angle-right"></i></strong>
                        </a>
                    </div>
                </div>
                
                <!-- Tasks Dropdown -->
                <div class="list-inline-item dropdown">
                    <a id="navbarDropdownMenuLink2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link tasks-toggle">
                        <i class="icon-new-file"></i>
                        <span class="badge dashbg-3">9</span>
                    </a>
                    <div aria-labelledby="navbarDropdownMenuLink2" class="dropdown-menu tasks-list">
                        <a href="#" class="dropdown-item">
                            <div class="text d-flex justify-content-between">
                                <strong>Task 1</strong>
                                <span>40% complete</span>
                            </div>
                            <div class="progress">
                                <div role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-1"></div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item text-center"> 
                            <strong>See All Tasks <i class="fa fa-angle-right"></i></strong>
                        </a>
                    </div>
                </div>
                
                <!-- Languages dropdown -->
                <div class="list-inline-item dropdown">
                    <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle">
                        <img src="{{ asset('Admin_Template-main/img/flags/16/GB.png') }}" alt="English">
                        <span class="d-none d-sm-inline-block">English</span>
                    </a>
                    <div aria-labelledby="languages" class="dropdown-menu">
                        <a rel="nofollow" href="#" class="dropdown-item"> 
                            <img src="{{ asset('Admin_Template-main/img/flags/16/DE.png') }}" alt="German" class="mr-2">
                            <span>German</span>
                        </a>
                        <a rel="nofollow" href="#" class="dropdown-item"> 
                            <img src="{{ asset('Admin_Template-main/img/flags/16/FR.png') }}" alt="French" class="mr-2">
                            <span>French</span>
                        </a>
                    </div>
                </div>
                
                <!-- User Profile Dropdown -->
                <div class="list-inline-item dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle">
                        <img src="{{ asset('Admin_Template-main/img/avatar-6.jpg') }}" alt="User" class="avatar rounded-circle" width="30" height="30">
                        <span class="d-none d-sm-inline-block ml-2">{{ auth()->user()->name ?? 'Admin' }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <i class="fa fa-user mr-2"></i> Profile
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fa fa-cog mr-2"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                       <a href="{{ route('logout') }}" class="dropdown-item"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out mr-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>