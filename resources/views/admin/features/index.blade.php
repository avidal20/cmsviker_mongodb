@extends('admin.layoutAdminModule')

@section('title', trans('modules.mod_features_title'))

@section('content')
        <div class="row">
        @foreach ($features as $feature)

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a href="{{route($feature->route_name.'.index')}}">
                <img src="{{ asset($feature->image) }}">
                <h2>{{ $feature->name }}</h2>
            </a>
            </div>
        @endforeach
        </div>
@endsection