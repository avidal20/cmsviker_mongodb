@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_products_desc'))

@section('content')

<form id="form-obj" data-parsley-validate="" novalidate="" method="post" action="{{ route('kids.store') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
    <div class="form-horizontal form-label-left">
      
      <div class="form-group">
         <label for="category" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('modules.mod_products_field_category') }}<span class="required">*</label>
         <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="category" name="category" class="form-control" required="required">
               <option value="">{{ trans('config.app_field_select_value') }}</option>
               @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
               @endforeach
            </select>
         </div>
      </div>

      <div class="form-group">
         <label for="reference" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_reference')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="reference" type="text" required="required" class="form-control col-md-7 col-xs-12" maxlength="255" name="reference">
         </div>
      </div>

      <div class="form-group">
         <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_name')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="name" type="text" required="required" class="form-control col-md-7 col-xs-12" maxlength="255" name="name">
         </div>
      </div>

      <div class="form-group">
         <label for="alter_reference" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_reference_alternate')}}</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="alter_reference" type="text" class="form-control col-md-7 col-xs-12" maxlength="255" name="alter_reference">
         </div>
      </div>

       <div class="form-group">
          <label for="state" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_state')}}<span class="required">*</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="state" id="state" class="form-control" required="required">
              <option value="">{{trans('config.app_field_select_value')}}</option>
              <option value="1">{{trans('modules.mod_products_field_state_enabled')}}</option>
              <option value="0">{{trans('modules.mod_products_field_state_disabled')}}</option>
            </select>
          </div>
      </div>
                          
      <div class="x_title">
         <h2>{{trans('modules.mod_categories_field_description')}}</h2>
         <div class="clearfix"></div>
      </div>

      <textarea id="description" name="description"></textarea>


      <div class="x_title">
         <h2>{{trans('modules.mod_kids_fielset_product')}}</h2>
         <div class="clearfix"></div>
      </div>

      <div class="form-group">
         <label for="filter_category" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('modules.mod_products_field_filter_category') }}</label>
         <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="filter_category" class="form-control">
               <option value="">{{ trans('config.app_field_select_value') }}</option>
               @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
               @endforeach
            </select>
         </div>
      </div>

<div id="tableReport">

  <table id="tableProductIndex" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>{{ trans('modules.mod_products_field_reference') }}</th>
        <th>{{ trans('modules.mod_products_field_name') }}</th>
        <th>{{ trans('modules.mod_products_field_category') }}</th>
        <th>{{ trans('modules.mod_kids_field_add_product') }}</th>
      </tr>
    </thead>
      <tbody>
        @foreach($products as $product)
         <tr>
            <td>{{ $product->reference }}</td> 
            <td><a href="{{ route('products.edit',['id' => $product->id ]) }}" target="black">{{ $product->name }}</a></td>
            <td>{{ $product->md_category->name }}</td>
            <td>
      <div class="checkbox">
        <label class="">
          <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;" value="{{ $product->id }}" name="products[]"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
        </label>
      </div>
            </td>
        </tr>
      @endforeach
      </tbody>
  </table>

</div>

  <div class="ln_solid"></div>
      <div class="form-group">
         <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
            <button type="submit" class="btn btn-success">{{trans('config.app_create')}}</button>
         </div>
      </div>
      
   </div>
</form>

@endsection

@section('js')

<script type="text/javascript">

  $(document).ready(function() {

      //Objeto del editor html
      $('#description').summernote({
          lang: 'es-ES',
          height: 150
      },'');

      $("#filter_category").change(function() {
        $.ajax({
            type: 'GET',
            dataType: 'html',
            url: '{{ route('kids.ajax.product') }}/'+$(this).val(),
            success: function(d) {
              $("#tableReport").html(d);
            }
        });
      });

    $("#tableProductIndex").DataTable({
        responsive: true,
        language: {
          "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
        },
        "paging": false
    });

  });

</script>

@endsection