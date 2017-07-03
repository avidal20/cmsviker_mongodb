@extends('admin.layoutAdminModule')

@section('title', trans('modules.mod_groups_title'))

@section('content')

<table id="datatable-buttons" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>{{ trans('modules.mod_users_field_id_num') }}</th>
      <th>{{ trans('modules.mod_users_field_first_name') }}</th>
      <th>{{ trans('modules.mod_users_field_last_name') }}</th>
      <th>{{ trans('modules.mod_users_field_email') }}</th>
      <th>{{ trans('modules.mod_users_field_cupon_status') }}</th>
      <th>{{ trans('modules.mod_users_field_supervisor') }}</th>
      <th>{{ trans('config.app_edit') }}</th>
      <th>{{ trans('config.app_delete') }}</th>
    </tr>
  </thead>
    <tbody>
      @foreach($users as $user)
       <tr>
          <td>{{ $user->id_number }}</td> 
          <td>{{ $user->name }}</td>
          <td>{{ $user->last_name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            Estado del cup&oacute;n
          </td>
          <td>
            <div class="checkbox">
              <label class="">
                  <div class="icheckbox_flat-green" id="checkGroupAdmin" style="position: relative;">
                    <input id="userAll" type="checkbox" name="isGroupAdmin" data-userid="{{$user->id}}" class="flat" style="position: absolute; opacity: 0;"  @if (!is_null($user->is_group_admin) && $user->is_group_admin == 1) checked @endif >
                    <ins id="insUserAll" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                  </div>
              </label>
            </div>
          </td>
          <td><a href="{{ route('groups.editUser',['id' => $user->id ]) }}"><i class="fa fa-edit fa-2x"></i></a></td>
          <td><a href="{{ route('groups.showUser',['id' => $user->id ]) }}"><i class="fa fa-remove fa-2x"></i></a></td>
      </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section('js')

<script>

  $(document).ready(function() {
    $("#checkGroupAdmin").click(function(){
        var input = $(this).find("#userAll");
        var userId = input.attr("data-userid");
        var newValue = input.is(":checked")? 0 : 1;
        var _token = "{{ csrf_token() }}";
        var _method = "PUT";

        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: "{{ route('groups.ajax.changeadmin') }}",
            type: 'POST',
            cache: false,
            data: {'user': userId, 'newValue' : newValue, '_token': _token, '_method': _method},
            success: function(data) {
              alert("Usuario actualizado");
            }
        });

     });

  });

</script>
@endsection