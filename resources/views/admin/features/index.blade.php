@extends('admin.layoutAdminModule')

@section('title', trans('modules.mod_features_title'))

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

          @role('sizes.module')
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <img src="{{ asset('media/modules/talla.png') }}">
            <h2><a href="{{ route('sizes.index') }}">{{ trans('modules.mod_features_gst_size_title') }}</a></h2>
          </div>
          @endrole

          @role('colors.module')
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <img src="{{ asset('media/modules/color.png') }}">
            <h2><a href="{{ route('colors.index') }}">{{ trans('modules.mod_features_gst_color_title') }}</a></h2>
          </div>
          @endrole
          
        </div>
    </div>
@endsection