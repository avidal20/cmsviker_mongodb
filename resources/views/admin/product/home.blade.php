@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_products_desc'))

@section('content')

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
            <img src="{{ asset('media/modules/producto.png') }}">
            <h2><a href="{{ route('products.index') }}">{{ trans('config.mod_products_name') }}</a></h2>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <img src="{{ asset('media/modules/kids.png') }}">
            <h2><a href="{{ route('kids.index') }}">{{ trans('config.mod_kids_name') }}</a></h2>
          </div>
        </div>
      </div>

@endsection