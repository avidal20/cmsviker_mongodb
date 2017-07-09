@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_users_desc'))

@section('content')

<form id="form-obj" data-parsley-validate="" novalidate="" method="post" action="{{ route('users.store') }}">
  {{ csrf_field() }}
    <div class="form-horizontal form-label-left">
                        
      <div class="form-group">
         <label for="username" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_users_field_username')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="username" type="text" required="required" class="form-control col-md-7 col-xs-12" maxlength="255" name="username" value="{{ old('username') }}">
         </div>
      </div>

      <div class="form-group">
         <label for="id_number" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_users_field_id_num')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="id_number" type="number" required="required" class="form-control col-md-7 col-xs-12" maxlength="255" name="id_number" value="{{ old('id_number') }}">
         </div>
      </div>

      <div class="form-group">
         <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_users_field_first_name')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="name" type="text" required="required" class="form-control col-md-7 col-xs-12" maxlength="255" name="name" value="{{ old('name') }}">
         </div>
      </div>

      <div class="form-group">
         <label for="last_name" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_users_field_last_name')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="last_name" type="text" required="required" class="form-control col-md-7 col-xs-12" maxlength="255" name="last_name" value="{{ old('last_name') }}">
         </div>
      </div>

      <div class="form-group">
         <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_users_field_email')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="email" type="email" required="required" class="form-control col-md-7 col-xs-12" maxlength="255" name="email" value="{{ old('email') }}">
         </div>
      </div>

      <div class="form-group">
         <label for="number_phone" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_users_field_number_phone')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="number_phone" type="number" class="form-control col-md-7 col-xs-12" maxlength="255" name="number_phone" required="required" value="{{ old('number_phone') }}">
         </div>
      </div>

      <div class="form-group">
         <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_users_field_address')}}</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="address" type="text" class="form-control col-md-7 col-xs-12" maxlength="255" name="address" value="{{ old('address') }}">
         </div>
      </div>
     

       <div class="form-group">
          <label for="state" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_users_field_state')}}<span class="required">*</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="state" id="state" class="form-control" required="required">
              <option value="">{{trans('config.app_field_select_value')}}</option>
              <option value="1" @if(old('state') == '1') selected @endif>{{trans('modules.mod_users_field_state_enabled')}}</option>
              <option value="0" @if(old('state') == '0') selected @endif>{{trans('modules.mod_users_field_state_disabled')}}</option>
            </select>
          </div>
      </div>
      
      <div class="x_title">
         <h2>{{trans('modules.mod_users_fielset_password')}}</h2>
         <div class="clearfix"></div>
      </div>

      <div class="form-group">
         <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_users_field_password')}}<span class="required">*</span></span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="password" type="password" class="form-control col-md-7 col-xs-12" maxlength="255" name="password" requerid data-parsley-required>
         </div>
      </div>

      <div class="form-group">
         <label for="password_confirmation" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_users_field_confirm_password')}}<span class="required">*</span></span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="password_confirmation" type="password" class="form-control col-md-7 col-xs-12" maxlength="255" name="password_confirmation" requerid data-parsley-equalto="#password" data-parsley-required>
         </div>
      </div>
      

      <div class="form-group">
         <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
            <button type="submit" class="btn btn-success">{{trans('config.app_create')}}</button>
         </div>
      </div>
      
   </div>
</form>

@endsection