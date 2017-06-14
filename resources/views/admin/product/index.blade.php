@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_products_name'))

@section('content')

<div class="form-horizontal form-label-left">
  <div class="form-group">
     <label for="category" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('modules.mod_products_field_filter_category') }}<span class="required"></label>
     <div class="col-md-6 col-sm-6 col-xs-12">
        <select id="category" class="form-control" required="required">
           <option value="">{{ trans('config.app_field_select_value') }}</option>
           @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
           @endforeach
        </select>
     </div>
  </div>
</div>

<hr/>

<table id="tableProduct" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>{{ trans('modules.mod_products_field_reference') }}</th>
      <th>{{ trans('modules.mod_products_field_name') }}</th>
      <th>{{ trans('modules.mod_products_field_category') }}</th>
      <th>{{ trans('modules.mod_products_field_state') }}</th>
      <th>{{ trans('config.app_edit') }}</th>
      <th>{{ trans('config.app_delete') }}</th>
    </tr>
  </thead>
    <tbody>
      @foreach($products as $product)
       <tr>
          <td>{{ $product->reference }}</td> 
          <td>{{ $product->name }}</td>
          <td>{{ $product->category }}</td>
          <td>
            @if($product->state == 1)
              {{ trans('modules.mod_categories_field_state_enabled') }}
            @else
              {{ trans('modules.mod_categories_field_state_disabled') }}
            @endif
          </td>
          <td><a href="{{ route('products.edit',['id' => $product->id ]) }}"><i class="fa fa-edit fa-2x"></i></a></td>
          <td><a href="{{ route('products.show',['id' => $product->id ]) }}"><i class="fa fa-remove fa-2x"></i></a></td>
      </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function() {

var table;

table = $("#tableProduct").DataTable({
  responsive: true,
  language: {
    "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
  }
});

$("#category").change(function() {
  $.ajax({
      type: 'GET',
      dataType: 'json',
      url: 'products/ajax/category/'+$(this).val(),
      success: function(d) {
        table.destroy();
        table = $("#tableProduct").DataTable({
          data: d.data,
          responsive: true,
          language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
          }
        });

      }
  });
});

});
</script>
@endsection