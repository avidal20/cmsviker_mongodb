@extends('admin.layoutAdminModule')

@section('title', trans('modules.mod_features_title'))

@section('content')

<label>
Para realizar la importaci&oacute;n de usuarios tenga en cuenta la siguiente informaci&oacute;n:
</label>
<br>
<label>
&nbsp;&nbsp;&nbsp;- Usuario<br>
&nbsp;&nbsp;&nbsp;- {{ trans('modules.mod_users_field_id_num') }}<br>
&nbsp;&nbsp;&nbsp;- {{ trans('modules.mod_users_field_first_name') }}<br>
&nbsp;&nbsp;&nbsp;- {{ trans('modules.mod_users_field_last_name') }}<br>
&nbsp;&nbsp;&nbsp;- {{ trans('modules.mod_users_field_email') }}<br>
&nbsp;&nbsp;&nbsp;- {{ trans('modules.mod_users_field_number_phone') }}<br>
&nbsp;&nbsp;&nbsp;- {{ trans('modules.mod_users_field_address') }}<br>
&nbsp;&nbsp;&nbsp;- <small>{{ trans('modules.mod_groups_cupon_number') }}</small><br>
&nbsp;&nbsp;&nbsp;- {{ trans('modules.mod_users_field_supervisor') }} (ingrese el valor de 1 si es supervisor de lo contrario d&eacute;jelo vac&iacute;o)<br>
</label>
<br>
<label>
- El archivo cargado debe ser Excel (xls, xlsx), para descargarlo presione <a href="{{asset('media/formato_usuarios.xlsx')}}">aqu&iacute;</a><br>
</label>
<br>
<label>
- <strong>Nota: No debe haber más de una fila en blanco entre registros.</strong><br>
</label>
<br>
<br>
<div class="x_title">
    <h2>{{trans('modules.mod_groups_import')}}</h2>
    <div class="clearfix"></div>
</div>

<form method="post" action="{{route('groups.importUsersProcess', ['id' => $id])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-horizontal form-label-left">
        <br>
        <div class="form-group">
            <label for="file" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_groups_import_users')}}<span class="required">*</span></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="file" type="file"  class="form-control col-md-7 col-xs-12" name="file" required>
                <input id="group" type="hidden"  class="form-control col-md-7 col-xs-12" name="group" value="{{$id}}">
            </div>
        </div>
        <br>
    </div>
    <div class="x_title">
        <div class="clearfix"></div>
    </div>
    <br>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
            <button type="submit" class="btn btn-success">{{trans('modules.mod_groups_import')}}</button>
        </div>
    </div>
</form>
@endsection