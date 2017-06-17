@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_categories_name'))

@section('content')

<form id="form" data-parsley-validate="" novalidate="" method="post" action="{{ route('colors.update', ['id' => $color->id]) }}"  enctype="multipart/form-data">
	{{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-horizontal form-label-left">

        <div class="form-group">
            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{trans('modules.mod_categories_field_name')}}<span class="required"> *</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="name" type="text" name="name" value="{{$color->name}}" class="form-control col-md-7 col-xs-12" maxlength="255" required>
            </div>
        </div>

        <div class="form-group">
            <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_features_colors_current_image_title')}}</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <img src="{{ Storage::url($color->image)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_features_colors_edit_image_title')}}</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="image" name="image" type="file"  class="form-control col-md-7 col-xs-12 field_img" >
            </div>
        </div>

        <div class="form-group">
            <label for="state" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_categories_field_state')}}<span class="required"> *</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="state" id="state" class="form-control" required>
                    @if ( $color->state == 1)
                        <option value="1" selected>{{trans('modules.mod_categories_field_state_enabled')}}</option>
                        <option value="0">{{trans('modules.mod_categories_field_state_disabled')}}</option>
                    @else
                        <option value="1" >{{trans('modules.mod_categories_field_state_enabled')}}</option>
                        <option value="0" selected>{{trans('modules.mod_categories_field_state_disabled')}}</option>   
                    @endif
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

@section('js')
<script type="text/javascript">       
      $("#form").submit(function(event) {
          $(this).parsley().validate();
          if ($(this).parsley().isValid()) {
            return confirm("{{trans('modules.mod_features_colors_store_msj_confirm_edit')}}");
          }
          event.preventDefault();
      });

</script>
@endsection
@endsection