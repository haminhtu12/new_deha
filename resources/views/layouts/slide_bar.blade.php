<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="{{asset('/')}}">
                <svg
                    class="brand-icon"
                    xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="xMidYMid"
                    width="30"
                    height="33"
                    viewBox="0 0 30 33"
                >
                    <g fill="none" fill-rule="evenodd">
                        <path
                            class="logo-fill-blue"
                            fill="#7DBCFF"
                            d="M0 4v25l8 4V0zM22 4v25l8 4V0z"
                        />
                        <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                    </g>
                </svg>
                <span class="brand-name">Books Shop</span>
            </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-scrollbar">

            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">


                {{--                    @if (Auth::check() && Auth::user()->level == 'admin')--}}
                <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
                       aria-expanded="false" aria-controls="dashboard">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="dashboard"
                         data-parent="#sidebar-menu">
                        <div class="sub-menu">



                            <li >
                                <a class="sidenav-item-link" href="{{asset('dashboard')}}">
                                    <span class="nav-text">Ecommerce</span>

                                </a>
                            </li>

                        </div>
                    </ul>
                </li>

                <!-- User Management -->
                <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#user"
                       aria-expanded="false" aria-controls="user">
                        <i class="mdi mdi-account-box"></i>
                        <span class="nav-text">User Management</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="user"
                         data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li >
                                <a class="sidenav-item-link" href="#">
                                    <span class="nav-text">Users</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>

                <!-- End User Management -->


                <!-- Product Management -->

                <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#product"
                       aria-expanded="false" aria-controls="product">
                        <i class="mdi mdi-shopify"></i>
                        <span class="nav-text">Products Management</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="product"
                         data-parent="#sidebar-menu">
                        <div class="sub-menu">



                            <li >
                                <a class="sidenav-item-link" href="{{asset('cate_management')}}">
                                    <span class="nav-text">Category</span>

                                </a>
                            </li>






                            <li >
                                <a class="sidenav-item-link" href="{{asset('product_management')}}">
                                    <span class="nav-text">Product</span>

                                </a>
                            </li>



                            <li >
                                <a class="sidenav-item-link" href="{{asset('proDetail_management')}}">
                                    <span class="nav-text">Product Details</span>

                                </a>
                            </li>




                        </div>
                    </ul>
                </li>

                <!-- End Product -->


                <!-- News Management -->

{{--                <li  class="has-sub" >--}}
{{--                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#news"--}}
{{--                       aria-expanded="false" aria-controls="news">--}}
{{--                        <i class="mdi mdi-book-open-page-variant"></i>--}}
{{--                        <span class="nav-text">News Management</span> <b class="caret"></b>--}}
{{--                    </a>--}}
{{--                    <ul  class="collapse"  id="news"--}}
{{--                         data-parent="#sidebar-menu">--}}
{{--                        <div class="sub-menu">--}}



{{--                            <li >--}}
{{--                                <a class="sidenav-item-link" href="{{asset('newscate_management')}}">--}}
{{--                                    <span class="nav-text">Category</span>--}}

{{--                                </a>--}}
{{--                            </li>--}}






{{--                            <li >--}}
{{--                                <a class="sidenav-item-link" href="{{asset('tag_management')}}">--}}
{{--                                    <span class="nav-text">Tags</span>--}}

{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li >--}}
{{--                                <a class="sidenav-item-link" href="{{asset('news_management')}}">--}}
{{--                                    <span class="nav-text">News</span>--}}

{{--                                </a>--}}
{{--                            </li>--}}



{{--                        </div>--}}
{{--                    </ul>--}}
{{--                </li>--}}

                <!-- End News -->


                <!-- Orders Management -->

                <li  class="has-sub" >
                    <a class="sidenav-item-link" href="{{asset('order')}}"
                       aria-expanded="false" aria-controls="orders">
                        <i class="mdi mdi-shopping"></i>
                        <span class="nav-text">Orders Management</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="orders"
                         data-parent="#sidebar-menu">
                        <div class="sub-menu">



                            {{--                                        <li >--}}
                            {{--                                            <a class="sidenav-item-link" href="{{asset('order')}}">--}}
                            {{--                                                <span class="nav-text">Orders</span>--}}

                            {{--                                            </a>--}}
                            {{--                                        </li>--}}
                        </div>
                    </ul>
                </li>

                <!-- End Orders -->
                {{--                    @endif--}}
            </ul>

        </div>

        <hr class="separator" />


    </div>
</aside>
