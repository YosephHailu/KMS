<div class="sidebar sidebar-secondary sidebar-light sidebar-expand-md m-0 p-0" style="
min-height: 150px">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler bg-slate-800 text-center">
        <a href="#" class="sidebar-mobile-secondary-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">{{__('app.nav_navigation')}}</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar tabs -->

        <!-- Main navigation -->
        <div class="card-body p-0">
            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="{{url('/')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{__('app.nav_home')}}</a>
                        @yield('breadcrumb')
                    </div>

                </div>
            </div>
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <!-- Main -->
                <li class="nav-item-header mt-0">
                    <div class="text-uppercase font-size-xs line-height-xs">{{__('app.nav_navigation')}}</div> <i class="icon-menu"
                        title="Main"></i>
                </li>
                <li class="nav-item">
                    <a href="{{url('dashboard')}}" class="nav-link {{ (Request::is('*dashboard*') ? 'active' : '') }}">
                        <i class="icon-home4"></i>
                        <span>
                            {{__('app.nav_home')}}
                        </span>
                    </a>
                </li>

                @if(Auth::user()->hasAnyPermission('all', 'manage knowledge'))
                <li class="nav-item active"><a href="{{url('projects')}}"
                        class="nav-link {{ (Request::is('projects*') ? 'active' : '') }}"><i class="icon-office"></i>
                        <span>{{__('app.nav_projects')}}</span></a></li>
                <li class="nav-item nav-item-submenu {{ (Request::is('knowledge*') ? 'nav-item-open' : '') }}
                                                            {{ (Request::is('document*') ? 'nav-item-open' : '') }}
                                                            {{ (Request::is('video*') ? 'nav-item-open' : '') }}
                                                            {{ (Request::is('map*') ? 'nav-item-open' : '') }}
                                                            {{ (Request::is('approve*') ? 'nav-item-open' : '') }}
                                                            {{ (Request::is('photo*') ? 'nav-item-open' : '') }}">
                    <a href="#" class="nav-link"><i class="icon-copy"></i>
                        <span>{{__('app.nav_knowledge_management')}}</span></a>

                    <ul class="nav nav-group-sub m-0"
                        style="{{ (Request::is('knowledge*') ? 'display:block' : '') }}
                                                                    {{ (Request::is('document*') ? 'display:block' : '') }}
                                                                    {{ (Request::is('video*') ? 'display:block' : '') }}
                                                                    {{ (Request::is('map*') ? 'display:block' : '') }}
                                                                    {{ (Request::is('approve*') ? 'display:block' : '') }}
                                                                    {{ (Request::is('photo*') ? 'display:block' : '') }}"
                        data-submenu-title="Knowledge Products">
                        <li class="nav-item"><a href="{{url('knowledge')}}"
                                class="nav-link {{ (Request::is('knowledge*') ? 'active' : '') }}">{{__('app.nav_all_knowledge_products')}}</a>
                        </li>
                        <li class="nav-item nav-item-submenu {{ (Request::is('document*') ? 'nav-item-open' : '') }}">
                            <a href="#" class="nav-link"><span>{{__('app.nav_documents')}}</span></a>

                            <ul class="nav nav-group-sub"
                                style="{{ (Request::is('document*') ? 'display:block' : '') }}"
                                data-submenu-title="Document">
                                <li class="nav-item"><a href="{{url('document')}}" class="nav-link">
                                        {{__('app.nav_all_documents')}}</a></li>
                                @foreach (App\DocumentCategory::All() as $category)
                                <li class="nav-item"><a href="{{url('documents/filter/'.$category->id)}}"
                                        class="nav-link">{{$category->category}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item"><a href="{{url('video')}}"
                                class="nav-link {{ (Request::is('video*') ? 'active' : '') }}">{{__('app.nav_videos')}}</a>
                        </li>
                        <li class="nav-item"><a href="{{url('photo')}}"
                                class="nav-link {{ (Request::is('photo*') ? 'active' : '') }}">{{__('app.nav_photos')}}</a>
                        </li>
                        <li class="nav-item"><a href="{{url('map')}}"
                                class="nav-link {{ (Request::is('map*') ? 'active' : '') }}">{{__('app.nav_maps')}}</a>
                        </li>
                        @if(Auth::user()->hasAnyPermission(['all', 'manage directorate']))
                        <li class="nav-item bg-danger"><a href="{{url('approve')}}"
                                class="nav-link {{ (Request::is('approve*') ? 'active' : '') }}">{{__('app.nav_Approve_knowledge')}}</a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                <li class="nav-item"><a href="{{url('board')}}"
                        class="nav-link {{ (Request::is('board*') ? 'active' : '') }}"><i
                            class="icon-notification2"></i> <span>{{__('app.nav_communication_board')}}</span></a></li>
                @if(Auth::user()->hasAnyPermission('all', 'manage directorate'))
                <li class="nav-item"><a href="{{url('directorateUser')}}"
                        class="nav-link {{ (Request::is('users*') ? 'active' : '') }}"><i class="icon-people"></i>
                        <span>{{__('app.nav_directorate_users')}}</span></a></li>
                @endif

                @if(Auth::user()->hasAnyPermission('all'))
                <li class="nav-item">
                    <a href="{{url('news')}}" class="nav-link {{ (Request::is('news*') ? 'active' : '') }}">
                        <i class="icon-newspaper"></i>
                        <span>{{__('app.nav_news')}}</span>
                    </a>
                </li>
                <li class="nav-item"><a href="{{url('contact')}}"
                        class="nav-link {{ (Request::is('contact*') ? 'active' : '') }}"><i class="icon-phone"></i>
                        <span>{{__('app.nav_contact')}}</span></a></li>

                <li class="nav-item"><a href="{{url('users')}}"
                        class="nav-link {{ (Request::is('users*') ? 'active' : '') }}"><i class="icon-people"></i>
                        <span>{{__('app.nav_users')}}</span></a></li>
                @endif

                @if(Auth::user()->hasAnyPermission('all'))
                <li class="nav-item"><a href="{{url('directorate')}}"
                        class="nav-link {{ (Request::is('directorate*') ? 'active' : '') }}"><i class="icon-office"></i>
                        <span>{{__('app.nav_directorate')}}</span></a></li>
                <li class="nav-item"><a href="{{url('finance')}}"
                        class="nav-link {{ (Request::is('finance*') ? 'active' : '') }}"><i class="icon-cash4"></i>
                        <span>{{__('app.nav_finance_source')}}</span></a></li>

                <li class="nav-item"><a href="{{url('slider')}}"
                        class="nav-link {{ (Request::is('slider*') ? 'active' : '') }}"><i
                            class="icon-presentation"></i> <span>{{__('app.nav_slider')}}</span></a></li>
                <li class="nav-item"><a href="{{url('link')}}"
                        class="nav-link {{ (Request::is('link*') ? 'active' : '') }}"><i class="icon-menu"></i>
                        <span>{{__('app.nav_important_links')}}</span></a></li>
                <!-- /main -->

                <!-- Layout -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">{{__('app.nav_system_configuration')}}</div>
                    <i class="icon-menu" title="Layout options"></i>
                </li>
                <li class="nav-item"><a href="{{url('access')}}"
                        class="nav-link {{ (Request::is('access*') ? 'active' : '') }}"><i
                            class="icon-accessibility"></i> <span>{{__('app.nav_access_control')}}</span></a></li>
                <li class="nav-item"><a href="{{url('configuration')}}"
                        class="nav-link {{ (Request::is('configuration*') ? 'active' : '') }}"><i class="icon-gear"></i>
                        <span>{{__('app.nav_configuration')}}</span></a></li>
                <li class="nav-item"><a href="{{url('company')}}"
                    class="nav-link {{ (Request::is('company*') ? 'active' : '') }}"><i class="icon-office"></i>
                    <span>{{__('app.nav_company')}}</span></a></li>
                <!-- /layout -->
                @endif
            </ul>
        </div>
        <!-- /main navigation -->
    </div>
</div>
<!-- /sidebar content -->