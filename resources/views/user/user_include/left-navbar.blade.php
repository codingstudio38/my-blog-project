<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar  flex-column " data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">


    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ route('indexpage') }}"> 
            <img alt="Logo" src="{{ url('/') }}/assets/media/logos/logo.PNG"
                class="h-30px app-sidebar-logo-default" />
        </a>
        <!--end::Logo image--> 

        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-sm h-30px w-30px rotate "
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">

            <i class="ki-duotone ki-double-left fs-2 rotate-180"><span class="path1"></span><span
                    class="path2"></span></i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->
            <div class="
                menu
                menu-column
                menu-rounded
                menu-sub-indention
                fw-semibold
                px-3
            "
                id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">



                <div class="menu-item">
                    <a class="menu-link {{ request()->is('user') ? 'active' : '' }}" href="{{ route('user-home') }}">
                        <span class="menu-icon"><i class="ki-duotone ki-category fs-2"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span><span
                                    class="path4"></span></i></span>
                        <span class="menu-title">Dashboard</span></a>
                </div>



                {{-- <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion
                     {{ request()->is('user/view-blog') ? 'here show' : '' }}
                     {{ request()->is('user/add-new-blog') ? 'here show' : '' }}">
                    <span class="menu-link"><span class="menu-icon"><i class="ki-duotone ki-address-book fs-2"><span
                                    class="path1"></span><span class="path2"></span><span
                                    class="path3"></span></i></span><span class="menu-title">Blog</span><span
                            class="menu-arrow"></span></span>

                    <div class="menu-sub menu-sub-accordion"> 
                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('user/view-blog') ? 'active' : '' }}"
                                href="{{ route('view-blog') }}"><span class="menu-bullet"><span
                                        class="bullet bullet-dot"></span></span><span class="menu-title">All Blog</span></a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ request()->is('user/add-new-blog') ? 'active' : '' }}"
                                href="{{ route('add-new-blog') }}"><span class="menu-bullet"><span
                                        class="bullet bullet-dot"></span></span><span class="menu-title">Add Blog</span></a>
                        </div>


                    </div>
                </div> --}}

                <div class="menu-item">
                    <a class="menu-link {{ request()->is('user/view-blog') ? 'active' : '' }}"
                        href="{{route('view-blog')}}"><span class="menu-icon"><i class="fa fa-th-list" aria-hidden="true" style=" font-size: 19px; "></i><span class="path1"></span><span class="path2"></span></i></span><span class="menu-title">My Blogs</span></a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('user/add-new-blog') ? 'active' : '' }}"
                        href="{{route('add-new-blog')}}"><span class="menu-icon"><i class="fa fa-plus-circle" aria-hidden="true" style=" font-size: 19px; "></i><span class="path1"></span><span class="path2"></span></i></span><span class="menu-title">Add New Blog</span></a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('user/user-profile') ? 'active' : '' }}"
                        href="{{route('user-profile')}}"><span class="menu-icon"><i class="fa fa-user-circle" aria-hidden="true" style=" font-size: 19px; "></i><span class="path1"></span><span class="path2"></span></i></span><span class="menu-title">My Profile</span></a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('user/user-logout') ? 'active' : '' }}"
                        href="{{route('user-logout')}}"><span class="menu-icon"><i class="fa fa-sign-out" aria-hidden="true" style=" font-size: 19px; "></i><span class="path1"></span><span
                                    class="path2"></span></i></span><span class="menu-title">Logout</span></a>
                </div>



            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->

</div>
<!--end::Sidebar-->
