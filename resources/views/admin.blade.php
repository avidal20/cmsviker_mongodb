@extends('admin.layoutAdmin')
@section('title', trans('config.app_page_panel_admin'))
@section('content')

<div class="right_col" role="main">

      @include('helpers.alerts')

      <div class="row top_tiles">

            @role('category.module')
            
               <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <div class="tile-stats">
                     <div class="icon"><i class="fa fa-key"></i></div>
                     <div class="count"><a href="{{ route('categories.index') }}">{{ trans('config.mod_categories_name') }}</a></div>
                     <h3>{{ trans('config.mod_categories_desc') }}</h3>
                  </div>
               </div>

            @endrole
            
            @if(Auth::check() && Auth::user()->hasRole('colors.module') || Auth::check() && Auth::user()->hasRole('sizes.module'))

            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
               <div class="tile-stats">
                  <div class="icon"><i class="fa fa-cogs"></i></div>
                  <div class="count"><a href="{{ route('features') }}">{{ trans('config.mod_features_name') }}</a></div>
                  <h3>{{ trans('config.mod_features_desc') }}</h3>
               </div>
            </div>

            @endif

            @if(Auth::check() && Auth::user()->hasRole('products.module') || Auth::check() && Auth::user()->hasRole('kids.module'))

            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
               <div class="tile-stats">
                  <div class="icon"><i class="fa fa-shopping-bag"></i></div>
                  <div class="count"><a href="{{ route('products.home') }}">{{ trans('config.mod_products_name') }}</a></div>
                  <h3>{{ trans('config.mod_products_desc') }}</h3>
               </div>
            </div>

            @endif

            @role('groups.module')
            
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
               <div class="tile-stats">
                  <div class="icon"><i class="fa fa-cubes"></i></div>
                  <div class="count"><a href="{{ route('groups.index') }}">{{ trans('modules.mod_groups_title_admin') }}</a></div>
                  <h3>{{ trans('modules.mod_groups_title') }}</h3>
               </div>
            </div>

            @endrole
            
            @role('users.module')

            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
               <div class="tile-stats">
                  <div class="icon"><i class="fa fa-user-circle-o"></i></div>
                  <div class="count"><a href="{{ route('users.index') }}">{{ trans('config.mod_users_name') }}</a></div>
                  <h3>{{ trans('config.mod_users_desc') }}</h3>
               </div>
            </div>

            @endrole
      </div>

   </div>
</div>
@endsection
