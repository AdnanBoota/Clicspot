<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{Request::path() == '/' ? 'active' : ''}}">
                <a href="{{url("")}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @if(Auth::user()->type == "superadmin")
            <li class="{{Request::path() == 'vendorList' ? 'active' : ''}}">
                <a href="{{url("vendorList")}}">
                    <i class="fa fa fa-files-o"></i> <span>Vendors</span>
                </a>
            </li>
            @endif
            <li class="{{Request::path() == 'hotspot' ? 'active' : ''}}">
                <a href="{{url("hotspot")}}">
                    <i class="fa fa fa-files-o"></i> <span>Hotspots</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>