@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_products_desc'))

@section('content')

<form id="form" data-parsley-validate="" novalidate="" method="post" action="{{ route('kids.update',['id' => $kid->id]) }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('PUT') }}    
    <div class="form-horizontal form-label-left">
      
      <div class="form-group">
         <label for="category" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('modules.mod_products_field_category') }}<span class="required">*</label>
         <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="category" name="category" class="form-control" required="required">
               <option value="">{{ trans('config.app_field_select_value') }}</option>
               @foreach($categories as $category)
                @if($kid->category == $category->id or $category->state != 0)
                  <option value="{{ $category->id }}" @if($category->id == $kid->category) selected @endif>{{ $category->name }}</option>
                @endif
               @endforeach
            </select>
         </div>
      </div>

      <div class="form-group">
         <label for="reference" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_reference')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="reference" type="text" required="required" class="form-control col-md-7 col-xs-12" maxlength="255" name="reference" value="{{ $kid->reference }}">
         </div>
      </div>

      <div class="form-group">
         <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_name')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="name" type="text" required="required" class="form-control col-md-7 col-xs-12" maxlength="255" name="name" value="{{ $kid->name }}">
         </div>
      </div>

      <div class="form-group">
         <label for="alter_reference" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_reference_alternate')}}</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="alter_reference" type="text" class="form-control col-md-7 col-xs-12" maxlength="255" name="alter_reference" value="{{ $kid->alter_reference }}">
         </div>
      </div>

       <div class="form-group">
          <label for="state" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_state')}}<span class="required">*</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="state" id="state" class="form-control" required="required">
              <option value="">{{trans('config.app_field_select_value')}}</option>
              <option value="1" @if($kid->state == 1) selected @endif>{{trans('modules.mod_products_field_state_enabled')}}</option>
              <option value="0" @if($kid->state == 0) selected @endif>{{trans('modules.mod_products_field_state_disabled')}}</option>
            </select>
          </div>
      </div>
                          
      <div class="x_title">
         <h2>{{trans('modules.mod_categories_field_description')}}</h2>
         <div class="clearfix"></div>
      </div>

      <textarea id="description" name="description">{{ $kid->description }}</textarea>

      <div class="x_title">
         <h2>{{trans('modules.mod_kids_fielset_product')}}</h2>
         <div class="clearfix"></div>
      </div>

      <div id="contentProducts">
          <div class="row">
            @if ( count($kid->md_products)>0 )
              @foreach($kid->md_products as $product)
                <div class="col-md-4 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                  <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      <img src="{{ Storage::url($product->md_product->md_feactures[0]->md_imgs[0]->file) }}" class="img-responsive img-rounded" style="width:100px;height:100px;">
                    </div>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                      <p><strong>Referencia:</strong> {{ $product->md_product->reference }}</p>    
                      <p>{{ $product->md_product->name }}</p>    
                      <p>
                        @if ( count($product->md_product->md_size)>0 )
                          <ul class="list-inline prod_size">
                            @foreach ( $product->md_product->md_size as $index => $size )
                            <li>
                              <button type="button" class="btn btn-default btn-xs">{{ $size->name }}</button>
                            </li>
                            @endforeach
                          </ul>
                        @else
                             No hay tallas asociadas
                        @endif
                      </p> 
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <div class="x_content bs-example-popovers">
                 <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    {{ trans('modules.mod_kids_msj_not_product') }}
                </div>
              </div>
            @endif
          </div>
          <hr>
      </div>

      <div class="form-group">
         <label for="filter_category" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('modules.mod_products_field_filter_category') }}</label>
         <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="filter_category" class="form-control">
               <option value="0">{{ trans('config.app_field_select_value') }}</option>
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
          <div class="icheckbox_flat-green @if(in_array($product->id, $productSelected)) checked @endif inputProduct" style="position: relative;" data-inputproduct="{{ $product->id }}"><input id="{{ $product->id }}" type="checkbox" class="flat" style="position: absolute; opacity: 0;" value="{{ $product->id }}" @if(in_array($product->id, $productSelected)) checked @endif><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
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
            <button type="submit" class="btn btn-success">{{trans('config.app_edit')}}</button>
         </div>
      </div>
      
   </div>
</form>

@endsection

@section('js')

<script type="text/javascript">

  $(document).ready(function() {

      //Confirmar antes de enviar
      $("#form").submit(function(event) {
          $(this).parsley().validate();
          if ($(this).parsley().isValid()) {
            return confirm("{{trans('modules.mod_kids_edit_msj_confirm')}}");
          }
          event.preventDefault();
      });

      //Objeto del editor html
      $('#description').summernote({
          lang: 'es-ES',
          height: 150
      },'');

      $("#filter_category").change(function() {
        var url = '{{  route('kids.ajax.product.edit',['idKid' => $kid->id, 'id' => 'ID-REPLACE']) }}';
        var newurl = url.replace("ID-REPLACE", $(this).val());
        $.ajax({
            type: 'GET',
            dataType: 'html',
            url: newurl,
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

    $(".inputProduct").click(function(){
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

@endsection