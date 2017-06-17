  <table id="tableProductEdit" class="table table-striped table-bordered">
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
          <div class="icheckbox_flat-green @if(in_array($product->id, $productSelected)) checked @endif inputProductEdit" style="position: relative;" data-inputproduct="{{ $product->id }}"><input id="{{ $product->id }}" type="checkbox" class="flat" style="position: absolute; opacity: 0;" value="{{ $product->id }}" @if(in_array($product->id, $productSelected)) checked @endif><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
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

    $("#tableProductEdit").DataTable({
        responsive: true,
        language: {
          "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
        },
        "paging": false
    });

    $(".inputProductEdit").click(function(){
        var idInput = $(this).data("inputproduct");
        var _token = "{{ csrf_token() }}";
        var _method = "PUT";
        var idKid = '{{$kid->id}}';
        var checked = !$("#"+idInput).is(':checked');

        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: "{{ route('kids.ajax.product.select') }}",
            type: 'POST',
            cache: false,
            data: { 'checked': checked, 'idProduct': idInput, '_token': _token, '_method': _method, 'idKid':idKid},
            datatype: 'html',
            beforeSend: function() {
                //something before send
            },
            success: function(data) {
              $("#contentProducts").html(data);
            },
            error: function(xhr,textStatus,thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });
     });

});
</script>