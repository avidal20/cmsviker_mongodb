<table id="tableProduct" class="table table-striped table-bordered">
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
          <td>{{ $product->name }}</td>
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

<script type="text/javascript">
$(document).ready(function() {
    if ($("input.flat")[0]) {
        $(document).ready(function () {
            $('input.flat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });
    }


    $("#tableProduct").DataTable({
        responsive: true,
        language: {
          "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
        },
        "paging": false
    });
});
</script>