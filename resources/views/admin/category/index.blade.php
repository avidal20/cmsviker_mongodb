@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_categories_name'))

@section('content')
<table id="datatable-buttons" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>{{ trans('modules.mod_categories_field_name') }}</th>
      <th>{{ trans('modules.mod_categories_field_description') }}</th>
      <th>{{ trans('modules.mod_categories_field_state') }}</th>
      <th>Editar</th>
      <th>Eliminar</th>
    </tr>
  </thead>
  <tbody>
  @foreach($categories as $category)
   <tr>
      <td>{{ $category->name }}</td> 
      <td>{{ $category->description }}</td> 
      <td>
        @if($category->state == 1)
          {{ trans('modules.mod_categories_field_state_enabled') }}
        @else
          {{ trans('modules.mod_categories_field_state_disabled') }}
        @endif
      </td>
      <td><a href="{{ route('categories.edit',['id' => $category->id ]) }}"><i class="fa fa-edit fa-2x"></i></a></td>
      <td><a href="{{ route('categories.show',['id' => $category->id ]) }}"><i class="fa fa-remove fa-2x"></i></a></td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection