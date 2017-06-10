@extends('admin.layoutAdminModule')

@section('title', trans('modules.mod_features_title').'-'.trans('modules.mod_features_sizes_title'))

@section('content')

    <table id="datatable-buttons" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>@lang('labels.name')</th>
            <th>@lang('labels.sizes')</th>
            <th>@lang('labels.state')</th>
            <th>@lang('labels.edit')</th>
            <th>@lang('labels.delete')</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($sizesCategories as $sizesCategory)
                <tr>
                    <td>{{$sizesCategory->name}}</td>
                    <td></td>
                    <td>{{$sizesCategory->state}}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
                    
@endsection