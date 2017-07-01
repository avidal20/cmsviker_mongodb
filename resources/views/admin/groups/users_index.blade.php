@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_groups_title'))

@section('content')

<table id="datatable-buttons" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>{{ trans('modules.mod_users_field_username') }}</th>
      <th>{{ trans('modules.mod_users_field_id_num') }}</th>
      <th>{{ trans('modules.mod_users_field_first_name') }}</th>
      <th>{{ trans('modules.mod_users_field_last_name') }}</th>
      <th>{{ trans('modules.mod_users_field_email') }}</th>
      <th>{{ trans('modules.mod_users_field_state') }}</th>
      <th>{{ trans('modules.mod_users_field_permissions') }}</th>
      <th>{{ trans('config.app_edit') }}</th>
      <th>{{ trans('config.app_delete') }}</th>
    </tr>
  </thead>
    <tbody>
      @foreach($users as $user)
       <tr>
          <td>{{ $user->username }}</td> 
          <td>{{ $user->id_number }}</td> 
          <td>{{ $user->name }}</td>
          <td>{{ $user->last_name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            @if($user->state == 1)
              {{ trans('modules.mod_categories_field_state_enabled') }}
            @else
              {{ trans('modules.mod_categories_field_state_disabled') }}
            @endif
          </td>
          <td><a href="{{ route('users.permissions',['id' => $user->id ]) }}"><i class="fa fa-key fa-2x"></i></a></td>
          <td><a href="{{ route('users.edit',['id' => $user->id ]) }}"><i class="fa fa-edit fa-2x"></i></a></td>
          <td><a href="{{ route('users.show',['id' => $user->id ]) }}"><i class="fa fa-remove fa-2x"></i></a></td>
      </tr>
    @endforeach
    </tbody>
</table>
@endsection