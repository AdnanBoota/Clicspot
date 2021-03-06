<header class="main-header newheader">
<link rel="stylesheet" type="text/css" href="{{ asset('/cntry/css/msdropdown/dd.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('/cntry/css/msdropdown/flags.css') }}" />
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
            <li><a href="#"><span>{{ Lang::get('auth.activity') }}</span></a></li>
            <li><a href="#"><span>{{ Lang::get('auth.notification') }}</span></a></li>
        </ul>
        <div class="navbar-custom-menu userprofile">
            <ul class="nav navbar-nav">
                
                <li>
                    <div class="language">
<!--                {{  App::getLocale() }} -->
                <form action="{{ URL::route('language')  }}" method="post" id="language">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <input name="page" type="hidden" value="login">
                <select name="locale" id="countries">
                        <option value="en" {{  (App::getLocale()=='en') ? 'selected' : '' }} data-image="{{ asset('/cntry/images/msdropdown/icons/blank.gif') }}" data-imagecss="flag us"></option>

                        <option value="fr" {{  (App::getLocale()=='fr') ? 'selected' : '' }} data-image="{{ asset('/cntry/images/msdropdown/icons/blank.gif') }}" data-imagecss="flag gf"></option>
                    </select>
                   
                    
                </form>
                   
                    
                </form>
            </div>
                </li>
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
                                <small>{{ Lang::get('auth.member') }}
                                    {{ Lang::get('auth.since') }} {{ Carbon\Carbon::parse(\Illuminate\Support\Facades\Auth::user()->created_at)->format('d M Y') }}
                                </small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ url("/payment/4")}}" class="btn btn-default btn-flat">{{ Lang::get('auth.profile') }}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">{{ Lang::get('auth.signout') }}</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        
    </nav>
    @push('scripts')
    <script src="{{ asset('/cntry/js/msdropdown/jquery.dd.min.js') }}"></script>
    <script>
    $(function(){
        $("#countries").msDropdown();
           $("#countries").change(function(){
               
           $("#language").submit();
            });
           
        });
    </script>
    @endpush
</header>
<script type="text/javascript" src="/js/inline-manual-player.js"></script>
