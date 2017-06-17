@extends('admin.layoutAdminModule')

@section('title', trans('modules.mod_features_title'))

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
            @foreach ( $sizesCategories as $sizesCategory )
                <tr>
                    <td>{{ $sizesCategory->name }}</td>
                    <td>
                        @if ( count($sizesCategory->md_features_sizes)>0 )
                            @foreach ( $sizesCategory->md_features_sizes as $index => $size )
                                @if (!$loop->last)
                                    {{ $size->name }} -
                                @else
                                    {{ $size->name }}
                                @endif
                            @endforeach
                        @else
                             No hay tallas asociadas
                        @endif
                    </td>
                    <td>{{ $sizesCategory->state == 1? "Activo" : "Inactivo" }}</td>
                    <td><a href="{{ route('sizes.edit',['id' => $sizesCategory->id ]) }}"><i class="fa fa-edit fa-2x"></i></a></td>
                    <td><a href="{{ route('sizes.show',['id' => $sizesCategory->id ]) }}"><i class="fa fa-remove fa-2x"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection