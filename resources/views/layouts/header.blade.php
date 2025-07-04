<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Header Menu Wrapper-->
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                <!--begin::Header Nav-->
                <a href="#" class="brand-logo">
                    {{-- logo --}}
                </a>
                <!--end::Header Nav-->
            </div>
            <!--end::Header Menu-->
        </div>
        <!--end::Header Menu Wrapper-->
        <!--begin::Topbar-->
        <div class="topbar">
            <!--begin::Search-->
            <?php echo app('impersonate')->isImpersonating() ? '' : '
            <div class="dropdown" id="kt_quick_search_toggle">
                <div class="topbar-item changepassword" onclick="changePasswordModal()"  data-toggle="tooltip" data-theme="dark" title="Change Password" data-target="#changePasswordModal" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-lg btn-dropdown mr-1">
                        <span style="color:#faf603;" class="fa fa-key">

                        </span>
                    </div>
                </div>
                <!--end::Toggle-->
                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                    <div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
                        <!--begin:Form-->
                        <form method="get" class="quick-search-form">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="svg-icon svg-icon-lg">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                          fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                          fill="#000000" fill-rule="nonzero"/>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search..."/>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="quick-search-close ki ki-close icon-sm text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                        <!--begin::Scroll-->
                        <div class="quick-search-wrapper scroll" data-scroll="true" data-height="325"
                             data-mobile-height="200"></div>
                        <!--end::Scroll-->
                    </div>
                </div>
                <!--end::Dropdown-->
            </div>
            ' ?>
            <!--end::Search-->
            <!--end::Chat-->
            <!--begin::Languages-->
            {{--<div class="dropdown">--}}
                {{--<!--begin::Toggle-->--}}
                {{--<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">--}}
                    {{--<div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">--}}
                        {{--<img class="h-20px w-20px rounded-sm" src="assets/media/svg/flags/226-united-states.svg"--}}
                             {{--alt=""/>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!--end::Toggle-->--}}
                {{--<!--begin::Dropdown-->--}}
                {{--<div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">--}}
                    {{--<!--begin::Nav-->--}}
                    {{--<ul class="navi navi-hover py-4">--}}
                        {{--<!--begin::Item-->--}}
                        {{--<li class="navi-item">--}}
                            {{--<a href="#" class="navi-link">--}}
                                {{--<span class="symbol symbol-20 mr-3">--}}
                                    {{--<img src="assets/media/svg/flags/226-united-states.svg" alt=""/>--}}
                                {{--</span>--}}
                                {{--<span class="navi-text">English</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<!--end::Item-->--}}
                        {{--<!--begin::Item-->--}}
                        {{--<li class="navi-item active">--}}
                            {{--<a href="#" class="navi-link">--}}
                                {{--<span class="symbol symbol-20 mr-3">--}}
                                    {{--<img src="assets/media/svg/flags/128-spain.svg" alt=""/>--}}
                                {{--</span>--}}
                                {{--<span class="navi-text">Spanish</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<!--end::Item-->--}}
                        {{--<!--begin::Item-->--}}
                        {{--<li class="navi-item">--}}
                            {{--<a href="#" class="navi-link">--}}
                                {{--<span class="symbol symbol-20 mr-3">--}}
                                    {{--<img src="assets/media/svg/flags/162-germany.svg" alt=""/>--}}
                                {{--</span>--}}
                                {{--<span class="navi-text">German</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<!--end::Item-->--}}
                        {{--<!--begin::Item-->--}}
                        {{--<li class="navi-item">--}}
                            {{--<a href="#" class="navi-link">--}}
                                {{--<span class="symbol symbol-20 mr-3">--}}
                                    {{--<img src="assets/media/svg/flags/063-japan.svg" alt=""/>--}}
                                {{--</span>--}}
                                {{--<span class="navi-text">Japanese</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<!--end::Item-->--}}
                        {{--<!--begin::Item-->--}}
                        {{--<li class="navi-item">--}}
                            {{--<a href="#" class="navi-link">--}}
                                {{--<span class="symbol symbol-20 mr-3">--}}
                                    {{--<img src="assets/media/svg/flags/195-france.svg" alt=""/>--}}
                                {{--</span>--}}
                                {{--<span class="navi-text">French</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<!--end::Item-->--}}
                    {{--</ul>--}}
                    {{--<!--end::Nav-->--}}
                {{--</div>--}}
                {{--<!--end::Dropdown-->--}}
            {{--</div>--}}
            <!--end::Languages-->
            <!--begin::User-->
            <div class="topbar-item">
                <?php echo app('impersonate')->isImpersonating() ? '<a class="btn btn-sm btn-light-danger font-weight-bolder py-2 px-5">Simulating</a>' : '' ?>
                <div class="w-auto btn-clean d-flex align-items-center px-2"
                     id="kt_quick_user_toggle">
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                    <span class="text-light font-weight-bolder font-size-base d-none d-md-inline mr-3">
                        {{ Auth::user()->username ?? 'Sean' }}
                    </span>
                </div>
                <div class="navi mt-2">
                    <a href="{{ url('logout') }}" class="btn btn-sm btn-light-danger font-weight-bolder py-2 px-5">Sign Out</a>
<!--                    --><?php //echo app('impersonate')->isImpersonating() ? '<a href="/usersetting/leaveSimulate" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Leave Simulate</a>' : '<a href="' .url('logout') . '" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>' ?>
                </div>
            </div>
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
