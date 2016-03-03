<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar newmenu">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{Request::path() == '/' ? 'active' : ''}}">
                <a href="{{url("")}}">
                    <i><img src="{{ asset("img/homeicon.png") }}" /></i> <span>{{ Lang::get('auth.dashboard') }}</span><span class="act"></span>
                </a>
            </li>
            @if(Auth::user()->type == "superadmin")
            <li class="{{Request::path() == 'vendorList' ? 'active' : ''}}">
                <a href="{{url("vendorList")}}">
                    <i class="fa fa fa-files-o"></i> <span>{{ Lang::get('auth.vendor') }}</span><span class="act"></span>
                </a>
            </li>
            @endif
            <li class="{{Request::path() == 'hotspot' ? 'active' : ''}}">
                <a href="{{url("hotspot")}}">
                    <i><img src="{{ asset("img/hotspotico.png") }}" /></i> <span>{{ Lang::get('auth.hotspot') }}</span><span class="act"></span>
                </a>
            </li>
            <li class="{{Request::path() == 'campaign' ? 'active' : ''}}">
                <a href="{{url("campaign")}}">
                     <i><img src="{{ asset("img/campaignico.png") }}" /></i>  <span>{{ Lang::get('auth.campaign') }}</span><span class="act"></span>
                </a>
            </li>
            <li class="{{Request::path() == 'users' ? 'active' : ''}}">
                <a href="{{url("users")}}">
                    <i><img src="{{ asset("img/ulicon.png") }}" /></i> <span>{{ Lang::get('auth.user') }}</span><span class="act"></span>
                </a>
            </li>
            <li class="{{Request::path() == 'emails' ? 'active' : ''}}">
                <a href="{{url("emails")}}">
                    <i><img src="{{ asset("img/portalicon.png") }}" /></i> <span>{{ Lang::get('auth.emails') }}</span><span class="act"></span>
                </a>
            </li>
            <li class="{{Request::path() == 'payment' ? 'active' : ''}}">
                <a href="{{url("payment")}}">
                    <i><img src="{{ asset("img/payico.png") }}" /></i> <span>{{ Lang::get('auth.payment') }}</span><span class="act"></span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
