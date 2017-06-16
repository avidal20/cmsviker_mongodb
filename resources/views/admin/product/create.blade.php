@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_categories_name'))

@section('content')

<form id="form-obj" data-parsley-validate="" novalidate="" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
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
         <label for="alter_reference" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_reference_alternate')}}<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
             <input id="alter_reference" type="text" required="required" class="form-control col-md-7 col-xs-12" maxlength="255" name="alter_reference">
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
         <h2>{{trans('modules.mod_products_fielset_product_features')}}</h2>
         <div class="clearfix"></div>
      </div>

      <div class="form-group">
          <label for="type_size" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_type_size')}}<span class="required">*</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="type_size" id="type_size" class="form-control" required="required">
              <option value="">{{trans('config.app_field_select_value')}}</option>
              @foreach($sizes as $size)
                <option value="{{$size->id}}">{{$size->name}}</option>
              @endforeach
            </select>
          </div>
      </div>

      <div id="contentInputTypeSize"></div>

       <div class="form-group">
          <a href="#" class="control-label col-md-3 col-sm-3 col-xs-12" id="addFielset">
          <i class="fa fa-plus"></i> {{trans('modules.mod_products_field_add_color')}}</a>
      </div>

    <div class="jumbotron formFielset" data-fielset="0">
        <div class="form-group">
            <label for="color_0" class="control-label col-md-3 col-sm-3 col-xs-12">Color<span class="required">*</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="color[0]" id="color_0" class="form-control" required="required">
                <option value="">{{trans('config.app_field_select_value')}}</option>
                @foreach($colors as $color)
                  <option value="{{$color->id}}">{{$color->name}}</option>
                @endforeach
              </select>
            </div>
        </div>

        <div class="form-group">
            <a data-fielset="0" href="#" class="control-label col-md-3 col-sm-3 col-xs-12 addImg">
            <i class="fa fa-plus"></i>{{trans('modules.mod_products_field_add_img')}}</a>
        </div>

        <div class="form-group">
            <label for="img_0" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_products_field_add_img_des')}}<span class="required">*</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input data-idField="0" id="img_0" type="file" required="required" class="form-control col-md-7 col-xs-12 field_img_0" maxlength="255" name="img[0][]">
            </div>
        </div>

        <div id="content_field_img_0"></div>
</div>

<div id="contentFielset"></div>

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