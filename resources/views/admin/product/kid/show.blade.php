@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_products_desc'))

@section('content')

<form id="form" data-parsley-validate="" novalidate="" method="post" action="{{ route('kids.destroy',['id' => $kid->id]) }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}
    <div class="form-horizontal form-label-left">
      
      <fieldset disabled="">
        
      <div class="form-group">
         <label for="category" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('modules.mod_products_field_category') }}</label>
         <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="category" name="category" class="form-control" >
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
         <label for="reference" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_reference')}}</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="reference" type="text"  class="form-control col-md-7 col-xs-12" maxlength="255" name="reference" value="{{ $kid->reference }}">
         </div>
      </div>

      <div class="form-group">
         <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_name')}}</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="name" type="text"  class="form-control col-md-7 col-xs-12" maxlength="255" name="name" value="{{ $kid->name }}">
         </div>
      </div>

      <div class="form-group">
         <label for="alter_reference" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_reference_alternate')}}</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="alter_reference" type="text"  class="form-control col-md-7 col-xs-12" maxlength="255" name="alter_reference" value="{{ $kid->alter_reference }}">
         </div>
      </div>

       <div class="form-group">
          <label for="state" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_state')}}</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="state" id="state" class="form-control" >
              <option value="">{{trans('config.app_field_select_value')}}</option>
              <option value="1" @if($kid->state == 1) selected @endif>{{trans('modules.mod_products_field_state_enabled')}}</option>
              <option value="0" @if($kid->state == 0) selected @endif>{{trans('modules.mod_products_field_state_disabled')}}</option>
            </select>
          </div>
      </div>

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
                    <p><a href="{{ route('products.edit',['id' => $product->md_product->id ]) }}" target="black">{{ $product->md_product->name }}</a></p>    
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
</fieldset>
  <div class="ln_solid"></div>
      <div class="form-group">
         <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
            <button type="submit" class="btn btn-success">{{trans('config.app_delete')}}</button>
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
            return confirm("{{trans('modules.mod_kids_delete_msj_confirm')}}");
          }
          event.preventDefault();
      });

      //Objeto del editor html
      $('#description').summernote({
          lang: 'es-ES',
          height: 150
      },'');

  });

</script>

@endsection