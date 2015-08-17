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
            <li class="{{Request::path() == '/subscribers' ? 'active' : ''}}">
                <a href="{{url("subscribers")}}">
                    <i class="fa fa fa-files-o"></i> <span>Subscribers</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>