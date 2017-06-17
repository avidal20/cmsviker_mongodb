@extends('admin.layoutAdminModule')

@section('title', trans('modules.mod_features_title'))

@section('content')

    <table id="datatable-buttons" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>@lang('labels.name')</th>
            <th>@lang('labels.state')</th>
            <th>@lang('labels.edit')</th>
            <th>@lang('labels.delete')</th>
        </tr>
        </thead>
        <tbody>
            @foreach ( $colors as $color )
                <tr>
                    <td>{{ $color->name }}</td>
                    <td>{{ $color->state == 1? "Activo" : "Inactivo" }}</td>
                    <td><a href="{{ route('colors.edit',['id' => $color->id ]) }}"><i class="fa fa-edit fa-2x"></i></a></td>
                    <td><a href="{{ route('colors.show',['id' => $color->id ]) }}"><i class="fa fa-remove fa-2x"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection