@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_categories_name'))

@section('content')

<form id="form" data-parsley-validate="" novalidate="" method="post" action="{{ route('categories.update',['id' => $product->id]) }}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}    

      <div class="form-horizontal form-label-left">
                        
      <div class="form-group">
         <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{trans('modules.mod_categories_field_name')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="name" type="text" required="required" class="form-control col-md-7 col-xs-12" maxlength="255" name="name" value="{{ $category->name }}">
         </div>
      </div>

      <div class="form-group">
          <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_categories_field_description')}}
          </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea id="description" class="form-control" rows="3" maxlength="550" name="description">{{ $category->description }}</textarea>
          </div>
      </div>

       <div class="form-group">
          <label for="state" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_categories_field_state')}}<span class="required">*</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="state" id="state" class="form-control" required="required">
              <option value="">{{trans('config.app_field_select_value')}}</option>
              <option value="1" @if($category->state == '1') selected @endif>{{trans('modules.mod_categories_field_state_enabled')}}</option>
              <option value="0" @if($category->state == '0') selected @endif>{{trans('modules.mod_categories_field_state_disabled')}}</option>
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

@section('js')
  <script type="text/javascript">       
      $("#form").submit(function(event) {
          $(this).parsley().validate();
          if ($(this).parsley().isValid()) {
            return confirm("{{trans('modules.mod_categories_store_msj_confirm_edit')}}");
          }
          event.preventDefault();
      });
  </script>
@endsection