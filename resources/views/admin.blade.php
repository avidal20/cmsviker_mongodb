@extends('admin.layoutAdmin')
@section('title', trans('config.app_page_panel_admin'))
@section('content')

<div class="right_col" role="main">

      @include('helpers.alerts')

      <div class="row top_tiles">
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
               <div class="tile-stats">
                  <div class="icon"><i class="fa fa-key"></i></div>
                  <div class="count"><a href="{{ route('categories.index') }}">{{ trans('config.mod_categories_name') }}</a></div>
                  <h3>{{ trans('config.mod_categories_desc') }}</h3>
               </div>
            </div>

            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
               <div class="tile-stats">
                  <div class="icon"><i class="fa fa-users"></i></div>
                  <div class="count"><a href="#">{{ trans('config.mod_features_name') }}</a></div>
                  <h3>{{ trans('config.mod_features_desc') }}</h3>
               </div>
            </div>

            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
               <div class="tile-stats">
                  <div class="icon"><i class="fa fa-calendar"></i></div>
                  <div class="count"><a href="#">{{ trans('config.mod_products_name') }}</a></div>
                  <h3>{{ trans('config.mod_products_desc') }}</h3>
               </div>
            </div>
      </div>

   </div>
</div>
@endsection
