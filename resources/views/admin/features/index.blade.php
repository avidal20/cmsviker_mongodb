@extends('admin.layoutAdminModule')

@section('title', trans('modules.mod_features_title'))

@section('content')
        <div class="row">
        @foreach ($features as $feature)
            <div class="col-md-3">
                <a href="{{route('features.'.$feature->route_name)}}">{{$feature->name}}</a>
            </div>
        @endforeach
        </div>
@endsection