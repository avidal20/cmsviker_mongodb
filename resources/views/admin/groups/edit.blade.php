@extends('admin.layoutAdminModule')

@section('title', trans('modules.mod_features_title'))

@section('content')

<form id="form-sizes" data-parsley-validate="" novalidate="" method="post" action="{{ route('groups.update', ['id'=>$group->id]) }}"  enctype="multipart/form-data">
	{{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-horizontal form-label-left">

        <div class="form-group">
            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{trans('modules.mod_categories_field_name')}}<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="name" type="text" name="name" value="{{$group->name}}" class="form-control col-md-7 col-xs-12" maxlength="255" required>
            </div>
        </div>

        <div class="form-group">
            <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_groups_description')}}</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea name="description" id="description" class="form-control col-md-7 col-xs-12" rows="8" maxlength="255">{{$group->description}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="state" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_categories_field_state')}}<span class="required">*</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="state" id="state" class="form-control" required>
                    <option value="">{{trans('config.app_field_select_value')}}</option>
                    <option value="1" @if($group->state == 1) selected @endif >{{trans('modules.mod_categories_field_state_enabled')}}</option>
                    <option value="0" @if($group->state == 0) selected @endif >{{trans('modules.mod_categories_field_state_disabled')}}</option>
                </select>
            </div>
        </div>

        <div class="ln_solid"></div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                <button type="submit" class="btn btn-success">{{trans('config.app_edit')}}</button>
            </div>
        </div>

    </div>
</form>

@endsection