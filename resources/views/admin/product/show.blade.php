@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_products_desc'))

@section('content')

<form id="form" data-parsley-validate="" novalidate="" method="post" action="{{ route('products.destroy',['id' => $product->_id] ) }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}
  
  <fieldset disabled="">
    <div class="form-horizontal form-label-left">
      
      <div class="form-group">
         <label for="category" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('modules.mod_products_field_category') }}</label>
         <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="category" name="category" class="form-control" >
               <option value="">{{ trans('config.app_field_select_value') }}</option>
               @foreach($categories as $category)
                @if($product->category == $category->id or $category->state != 0)
                  <option value="{{ $category->id }}" @if($product->category == $category->id) selected @endif >{{ $category->name }}</option>
                @endif
               @endforeach
            </select>
         </div>
      </div>

      <div class="form-group">
         <label for="reference" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_reference')}}</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="reference" type="text"  class="form-control col-md-7 col-xs-12" maxlength="255" name="reference" value="{{ $product->reference }}">
         </div>
      </div>

      <div class="form-group">
         <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_name')}}</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="name" type="text"  class="form-control col-md-7 col-xs-12" maxlength="255" name="name" value="{{ $product->name }}">
         </div>
      </div>

      <div class="form-group">
         <label for="alter_reference" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_reference_alternate')}}</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="alter_reference" type="text"  class="form-control col-md-7 col-xs-12" maxlength="255" name="alter_reference" value="{{ $product->alter_reference }}">
         </div>
      </div>

       <div class="form-group">
          <label for="state" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_state')}}</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="state" id="state" class="form-control" >
              <option value="">{{trans('config.app_field_select_value')}}</option>
              <option value="1" @if($product->state == "1") selected @endif >{{trans('modules.mod_products_field_state_enabled')}}</option>
              <option value="0" @if($product->state == "0") selected @endif >{{trans('modules.mod_products_field_state_disabled')}}</option>
            </select>
          </div>
      </div>

      <div class="x_title">
         <h2>{{trans('modules.mod_products_fielset_product_features')}}</h2>
         <div class="clearfix"></div>
      </div>

      <div class="form-group">
          <label for="type_size" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_type_size')}}</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="type_size" id="type_size" class="form-control" >
              <option value="">{{trans('config.app_field_select_value')}}</option>
              @foreach($sizes as $size)
                @if($product->type_size == $size->id or $product->state != 0)
                  <option value="{{$size->id}}" @if($product->type_size == $size->id) selected @endif>{{$size->name}}</option>
                @endif
              @endforeach
            </select>
          </div>
      </div>

      <div id="contentInputTypeSize">

      <div class="form-group">
         <label name="education" class="col-md-3 col-sm-3 col-xs-12 control-label">Tallas*</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            @foreach($product->md_size as $sizes)
                <div class="checkbox">
                  <label class="">
                    <div class="icheckbox_flat-green @if(in_array($sizes->id, $productSizesSelect)) checked @endif disabled" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;" value="{{ $sizes->id }}" name="sizes[]" @if(in_array($sizes->id, $productSizesSelect)) checked @endif disabled><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> {{ $sizes->name }}
                  </label>
                </div>
            @endforeach
         </div>
      </div>

      </div>

       <div class="form-group">
          <a href="#" class="control-label col-md-3 col-sm-3 col-xs-12" id="addFielset">
          <i class="fa fa-plus"></i> {{trans('modules.mod_products_field_add_color')}}</a>
      </div>

@foreach($product->md_feactures as $feactures)

  <div class="jumbotron formFielset" data-fielset="{{ $loop->index }}">
          <div class="form-group">
              <label for="color_{{ $loop->index }}" class="control-label col-md-3 col-sm-3 col-xs-12">Color</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="color[{{ $loop->index }}]" id="color_{{ $loop->index }}" class="form-control" >
                  <option value="">{{trans('config.app_field_select_value')}}</option>
                  @foreach($colors as $color)
                    @if($feactures->id_color == $color->id or $color->state != 0)
                      <option value="{{$color->id}}" @if($feactures->id_color == $color->id) selected @endif>{{$color->name}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
          </div>

          <div class="form-group">
              <a data-fielset="{{ $loop->index }}" href="#" class="control-label col-md-3 col-sm-3 col-xs-12 addImg">
              <i class="fa fa-plus"></i>{{trans('modules.mod_products_field_add_img')}}</a>
          </div>

          @foreach($feactures->md_imgs as $img)
          <div class="tmp">

              <div class="form-group">
                <label for="img_{{ $loop->parent->index  }}" class="control-label col-md-3 col-sm-3 col-xs-12"><a class="deleteImgEdit"><i class="fa fa-trash fa-2x"></i></a></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <img src="{{ Storage::url($img->file) }}" class="img-responsive img-rounded" style="width:100px;height:auto;">
                  </div>
                  <input type="hidden" name="img[{{ $loop->parent->index }}][]" value="{{ $img->file }}">
              </div>

              <div class="form-group">
                  <label for="img_{{ $loop->parent->index }}" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_add_img_des')}}</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input data-idField="{{ $loop->parent->index }}" id="img_{{ $loop->index }}" type="file"  class="form-control col-md-7 col-xs-12 field_img_{{ $loop->parent->index }}" maxlength="255" name="img[{{ $loop->parent->index }}][]">
                  </div>
              </div>

          </div>

          @endforeach

          <div id="content_field_img_{{ $loop->index }}"></div>
  </div>

@endforeach

<div id="contentFielset"></div>

<div class="ln_solid"></div>
       </fieldset>                    
      <div class="form-group">
         <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
            <button type="submit" class="btn btn-success">{{trans('config.app_delete')}}</button>
         </div>
      </div>
      
   </div>

</form>

@endsection

@section('js')

<script>

  $(document).ready(function() {

      //Confirmar antes de enviar
      $("#form").submit(function(event) {
          $(this).parsley().validate();
          if ($(this).parsley().isValid()) {
            return confirm("{{trans('modules.mod_products_delete_msj_confirm')}}");
          }
          event.preventDefault();
      });

  });


</script>

@endsection