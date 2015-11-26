<header class="main-header newheader">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>C</b>S</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <img src="{{asset("/img/logo.png")}}" height="40px;">
            </span>
    </a>
    <!-- Logo -->
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <ul class="headnav">
            <li><a href="#"><span>Activity</span></a></li>
            <li><a href="#"><span>Notifications</span><span class="notidtl">19</span></a></li>
        </ul>
        <div class="navbar-custom-menu userprofile">
            <ul class="nav navbar-nav">
                
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">{{ Auth::user()->username }}</span>
                        <div class="triangle-down"></div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"/>

                            <p>
                                {{ Auth::user()->username }}
                                <small>Member
                                    since {{ Carbon\Carbon::parse(\Illuminate\Support\Facades\Auth::user()->created_at)->format('d M Y') }}
                                </small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>