<header class="main-header " id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
        </button>
        <!-- search form -->
        <div class="search-form d-none d-lg-inline-block">
            <div class="input-group">
                <button type="button" name="search" id="search-btn" class="btn btn-flat">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <input type="text" name="query" id="search-input" class="form-control" placeholder="'button', 'chart' etc."
                       autofocus autocomplete="off" />
            </div>
            <div id="search-results-container">
                <ul id="search-results"></ul>
            </div>
        </div>

        <div class="navbar-right ">
            <ul class="nav navbar-nav">
                <!-- Github Link Button -->
                <li class="github-link mr-3">
                    <a href="#" title="Giỏ Hàng Ban Có Cart::count() Mặt Hàng "><i class="fa fa-cart-plus"></i></a>


                </li>
                <!-- User Account -->
                <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="{{asset(Auth::user()['cover'])}}" class="user-image" alt="User Image" />
                        <span class="d-none d-lg-inline-block">{{ Auth::user()['name']}}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <!-- User image -->
                        <li class="dropdown-header">
                            <img src="{{asset(Auth::user()['cover'])}}" class="img-circle" alt="User Image" />
                            <div class="d-inline-block">
                                {{ Auth::user()['name'] }} <small class="pt-1">{{ Auth::user()['email'] }}</small>
                            </div>
                        </li>

                        <li>
                            <a href="{{asset('profile')}}">
                                <i class="mdi mdi-account"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{asset('order')}}">
                                <i class="mdi mdi-bank-transfer"></i>History
                            </a>
                        </li>
                        <li>
                            <a href="{{asset('order_detail')}}"> <i class="mdi mdi-shopify"></i> Details of Order </a>
                        </li>
                        <li>
                            <a href="{{asset('dashboard')}}"> <i class="mdi mdi-ballot"></i> Dashboard </a>
                        </li>
                        {{--                                @if(Auth::check())--}}
                        <li class="dropdown-footer">
                            <a class="dropdown-item" href="logout"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="logout" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        {{--                                @else--}}
                        <li><a class="dropdown-item" href="login">login</a></li>
                        {{--                                @endif--}}
                    </ul>

                </li>
            </ul>

        </div>
    </nav>


</header>
