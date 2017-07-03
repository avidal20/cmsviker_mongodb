<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title', trans('config.Yubarta')) </title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="{{ asset('vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    

    @if(isset($plugins))
        @foreach($plugins as $plugin)

            @if(is_array(config('plugins.'.$plugin.'.css')))
                @foreach(config('plugins.'.$plugin.'.css') as $pluginArray)
                    <link href="{!! asset($pluginArray) !!}" rel="stylesheet" />
                @endforeach
            @else
                <link href="{!! asset(config('plugins.'.$plugin.'.css')) !!}" rel="stylesheet" />
            @endif

        @endforeach
    @endif

    <!-- Custom Theme Style -->
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/aplicacion.css') }}" rel="stylesheet">
    
    @yield('css')

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ route('admin') }}" class="site_title"><i class="fa fa-shopping-bag"></i> <span>{{ trans('config.app_name') }}</span></a>
            </div>

            
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="{{ asset('media/user.png') }}" class="img-circle profile_img"/>
              </div>
              <div class="profile_info">
                <span>{{ trans('config.app_welcome') }},</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>{{ trans('config.app_general') }}</h3>
                <ul class="nav side-menu">

                  <li>
                    <a href="{{ route('admin') }}"><i class="fa fa-home"></i>{{ trans('config.app_home') }}</a>
                  </li>

                  @role('category.module')
                    <li>
                      <a><i class="fa fa-folder"></i>{{ trans('config.mod_categories_name') }}<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                          @if(Auth::check() && Auth::user()->hasRole('category.all') || Auth::check() && Auth::user()->hasRole('category.list'))
                          <li><a href="{{ route('categories.index') }}">{{ trans('config.app_home') }}</a></li>
                          @endif
                          @if(Auth::check() && Auth::user()->hasRole('category.all') || Auth::check() && Auth::user()->hasRole('category.create'))
                          <li><a href="{{ route('categories.create') }}">{{ trans('config.app_create') }}</a></li>
                          @endif
                      </ul>
                    </li>
                  @endrole

                  @if(Auth::check() && Auth::user()->hasRole('colors.module') || Auth::check() && Auth::user()->hasRole('sizes.module'))
                  <li>
                    <a href="{{ route('features') }}"><i class="fa fa-cogs"></i>{{ trans('config.mod_features_name') }}</a>
                  </li>
                  @endif

                  @if(Auth::check() && Auth::user()->hasRole('products.module') || Auth::check() && Auth::user()->hasRole('kids.module'))
                  <li>
                    <a href="{{ route('products.home') }}"><i class="fa fa-shopping-bag"></i>{{ trans('config.mod_products_name') }}</a>
                  </li>
                  @endif
                  
                  <li>
                    <a><i class="fa fa-cogs"></i>{{ trans('config.mod_users_name') }}<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('users.index') }}">{{ trans('config.app_home') }}</a></li>
                      <li><a href="{{ route('users.create') }}">{{ trans('config.app_create') }}</a></li>
                    </ul>
                  </li>

                  @role('groups.module')
                    <li>
                      <a><i class="fa fa-cubes"></i>{{ trans('config.mod_groups_name') }}<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                          @if(Auth::check() && Auth::user()->hasRole('groups.all') || Auth::check() && Auth::user()->hasRole('groups.list'))
                          <li><a href="{{ route('groups.index') }}">{{ trans('config.app_home') }}</a></li>
                          @endif
                          @if(Auth::check() && Auth::user()->hasRole('groups.all') || Auth::check() && Auth::user()->hasRole('groups.create'))
                          <li><a href="{{ route('groups.create') }}">{{ trans('config.app_create') }}</a></li>
                          @endif
                      </ul>
                    </li>
                  @endrole

                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('media/user.png') }}"/> {{ Auth::user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    
                    <li>
                      <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out pull-right"></i> {{ trans('config.app_sign_off') }}
                      </a>

                      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>

                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
