@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_categories_name'))

@section('content')

<form id="form" data-parsley-validate="" novalidate="" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
    <div class="form-horizontal form-label-left">
      
      <div class="form-group">
         <label for="category" class="control-label col-md-3 col-sm-3 col-xs-12">{{ trans('modules.mod_products_field_category') }}<span class="required">*</label>
         <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="category" name="category" class="form-control" required="required">
               <option value="">{{ trans('config.app_field_select_value') }}</option>
               @foreach($categories as $category)
                <option value="{{ $category->id }}" @if($product->category == $category->id) selected @endif >{{ $category->name }}</option>
               @endforeach
            </select>
         </div>
      </div>

      <div class="form-group">
         <label for="reference" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_reference')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="reference" type="text" required="required" class="form-control col-md-7 col-xs-12" maxlength="255" name="reference" value="{{ $product->reference }}">
         </div>
      </div>

      <div class="form-group">
         <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_name')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="name" type="text" required="required" class="form-control col-md-7 col-xs-12" maxlength="255" name="name" value="{{ $product->name }}">
         </div>
      </div>

      <div class="form-group">
         <label for="reference_alternate" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_reference_alternate')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="reference_alternate" type="text" required="required" class="form-control col-md-7 col-xs-12" maxlength="255" name="reference_alternate" value="{{ $product->alter_reference }}">
         </div>
      </div>

       <div class="form-group">
          <label for="state" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_state')}}<span class="required">*</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="state" id="state" class="form-control" required="required">
              <option value="">{{trans('config.app_field_select_value')}}</option>
              <option value="1" @if($product->state == "1") selected @endif >{{trans('modules.mod_products_field_state_enabled')}}</option>
              <option value="0" @if($product->state == "1") selected @endif >{{trans('modules.mod_products_field_state_disabled')}}</option>
            </select>
          </div>
      </div>
                          
      <div class="x_title">
         <h2>{{trans('modules.mod_categories_field_description')}}</h2>
         <div class="clearfix"></div>
      </div>

      <textarea id="description" name="description">{{ $product->description }}</textarea>

      <div class="x_title">
         <h2>{{trans('modules.mod_products_fielset_product_features')}}</h2>
         <div class="clearfix"></div>
      </div>

      <div class="form-group">
          <label for="type_size" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_type_size')}}<span class="required">*</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="type_size" id="type_size" class="form-control" required="required">
              <option value="">{{trans('config.app_field_select_value')}}</option>
              @foreach($sizes as $size)
                <option value="{{$size->id}}" @if($product->type_size == $size->id) selected @endif>{{$size->name}}</option>
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
                    <div class="icheckbox_flat-green @if(in_array($sizes->id, $productSizesSelect)) checked @endif" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;" value="{{ $size->id }}" name="sizes[]" @if(in_array($sizes->id, $productSizesSelect)) checked @endif><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> {{ $sizes->name }}
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
              <label for="color_{{ $loop->index }}" class="control-label col-md-3 col-sm-3 col-xs-12">Color<span class="required">*</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="color[{{ $loop->index }}]" id="color_{{ $loop->index }}" class="form-control" required="required">
                  <option value="">{{trans('config.app_field_select_value')}}</option>
                  @foreach($colors as $color)
                    <option value="{{$color->id}}" @if($feactures->id_color == $color->id) selected @endif>{{$color->name}}</option>
                  @endforeach
                </select>
              </div>
          </div>

          <div class="form-group">
              <a data-fielset="{{ $loop->index }}" href="#" class="control-label col-md-3 col-sm-3 col-xs-12 addImg">
              <i class="fa fa-plus"></i>{{trans('modules.mod_products_field_add_img')}}</a>
          </div>

          @foreach($feactures->md_imgs as $img)

          <div class="form-group">
            <label for="img_{{ $loop->parent->index }}" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_add_img_des')}}<span class="required">*</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <img src="/storage/{{ $img->file }}" class="img-responsive img-rounded" alt="Cinque Terre" style="width:100px;height:auto;">
              </div>
          </div>

          <div class="form-group">
              <label for="img_{{ $loop->parent->index }}" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_add_img_des')}}<span class="required">*</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input data-idField="{{ $loop->parent->index }}" id="img_{{ $loop->index }}" type="file" required="required" class="form-control col-md-7 col-xs-12 field_img_{{ $loop->parent->index }}" maxlength="255" name="img[{{ $loop->parent->index }}][]">
              </div>
          </div>

          @endforeach

          <div id="content_field_img_{{ $loop->index }}"></div>
  </div>

@endforeach

<div id="contentFielset"></div>

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

<script>

  $(document).ready(function() {
      //Objeto del editor html
      $('#description').summernote({
          lang: 'es-ES',
          height: 150
      },'');


      $("#addFielset").click(function(e){
        e.preventDefault();

        var countField = $(".formFielset").last().data('fielset');
        countField++;

        var htmlfielset = '<div class="jumbotron formFielset" data-fielset="'+countField+'">'+
                '<a href="#" class="deleteFielset"><i class="fa fa-trash"></i></a>'+
                '<div class="form-group">'+
                    '<label for="color_'+countField+'" class="control-label col-md-3 col-sm-3 col-xs-12">Color<span class="required">*</label>'+
                    '<div class="col-md-6 col-sm-6 col-xs-12">'+
                      '<select name="color['+countField+']" id="color_'+countField+'" class="form-control" required="required">'+
                        '<option value="">{{trans('config.app_field_select_value')}}</option>'+
                          @foreach($colors as $color)
                            '<option value="{{$color->id}}">{{$color->name}}</option>'+
                          @endforeach
                      '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="form-group">'+
                    '<a data-fielset="'+countField+'" href="#" class="control-label col-md-3 col-sm-3 col-xs-12 addImg">'+
                    '<i class="fa fa-plus"></i>{{trans('modules.mod_products_field_add_img')}}</a>'+
                '</div>'+
                '<div class="form-group">'+
                    '<label for="img_'+countField+'_0" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_add_img_des')}}<span class="required">*</label>'+
                    '<div class="col-md-6 col-sm-6 col-xs-12">'+
                      '<input data-idField="0" id="img_'+countField+'_0" type="file" required="required" class="form-control col-md-7 col-xs-12 field_img_'+countField+'" maxlength="255" name="img['+countField+'][]">'+
                    '</div>'+
                '</div>'+
                '<div id="content_field_img_'+countField+'"></div>';
        '</div>';
        
        $("#contentFielset").append(htmlfielset);
      });

      //Agregar campos de archivos en los fielset
      $(document).on("click", "a.addImg", function(e){
          e.preventDefault();
          var idField = $(this).data('fielset');
          var count = $(".field_img_"+idField).last().data('idfield');
          count++;

          var htmlField = '<div class="form-group">'+
              '<label for="img_'+ idField +'_'+ count +'" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_add_img_des')}}<span class="required">*</label>'+
              '<div class="col-md-6 col-sm-6 col-xs-12">'+
                '<input data-idField="'+count+'" id="img_'+ idField +'_'+ count +'" type="file" required="required" class="form-control col-md-7 col-xs-12 field_img_'+idField+'" maxlength="255" name="img['+idField+'][]">'+
              '</div><a class="deleteImg"><i class="fa fa-trash"></i></a>'+
          '</div>';

          $("#content_field_img_"+idField).append(htmlField);

      });

      //Cargar inptus del tipo de talla
      $("#type_size").change(function(){
        var id = $(this).val();
        if(id == ''){ 
          $("#contentInputTypeSize").html('');
          return true;
        }
        var _token = "{{ csrf_token() }}";
        var _method = "PUT";

        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: '{{ route('products.ajax.InputsTypeSize') }}/'+id,
            type: 'POST',
            cache: false,
            data: { 'id': id, '_token': _token, '_method': _method},
            datatype: 'html',
            beforeSend: function() {
                //something before send
            },
            success: function(data) {
              $("#contentInputTypeSize").html(data)
            },
            error: function(xhr,textStatus,thrownError) {
                alert(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });
      });

      //Confirmar antes de enviar
      $("#form").submit(function(event) {
          $(this).parsley().validate();
          if ($(this).parsley().isValid()) {
            return confirm("{{trans('modules.mod_products_edit_msj_confirm')}}");
          }
          event.preventDefault();
      });

  });

  //Eliminar campo de archivos del fielset
  $(document).on("click", "a.deleteImg", function(e){
    e.preventDefault();
    $(this).parent().remove();
  });

  //Eliminar fielset
  $(document).on("click", "a.deleteFielset", function(e){
    e.preventDefault();
    $(this).parent().remove();
  });


</script>

@endsection