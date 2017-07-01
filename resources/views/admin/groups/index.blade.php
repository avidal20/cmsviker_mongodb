@extends('admin.layoutAdminModule')

@section('title', trans('modules.mod_groups_title'))

@section('content')

    <table id="datatable-buttons" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>@lang('labels.name')</th>
            <th>@lang('labels.description')</th>
            <th>@lang('labels.state')</th>
            <th>@lang('labels.users')</th>
            <th>@lang('labels.edit')</th>
            <th>@lang('labels.delete')</th>
        </tr>
        </thead>
        <tbody>
            @foreach ( $grupos as $grupo )
                <tr>
                    <td>{{ $grupo->name }}</td>
                    <td>{{ $grupo->description }}</td>
                    <td>{{ $grupo->state == 1? "Activo" : "Inactivo" }}</td>
                    <td><a href="{{ route('groups.users',['id' => $grupo->id ]) }}"><i class="fa fa-user fa-2x"></i></a></td>
                    <td><a href="{{ route('groups.edit',['id' => $grupo->id ]) }}"><i class="fa fa-edit fa-2x"></i></a></td>
                    <td><a href="{{ route('groups.show',['id' => $grupo->id ]) }}"><i class="fa fa-remove fa-2x"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection