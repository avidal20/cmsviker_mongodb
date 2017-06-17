@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_categories_name'))

@section('content')

<form id="form-sizes" data-parsley-validate="" novalidate="" method="post" action="{{ route('sizes.store') }}">
	{{ csrf_field() }}
    <div class="form-horizontal form-label-left">

        <div class="form-group">
            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{trans('modules.mod_categories_field_name')}}<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="name" type="text" name="name" class="form-control col-md-7 col-xs-12" maxlength="255" required>
            </div>
        </div>

        <div class="form-group">
            <label for="state" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_categories_field_state')}}<span class="required">*</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="state" id="state" class="form-control" required>
                    <option value="">{{trans('config.app_field_select_value')}}</option>
                    <option value="1">{{trans('modules.mod_categories_field_state_enabled')}}</option>
                    <option value="0">{{trans('modules.mod_categories_field_state_disabled')}}</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <a id="btnAddSize" hred="#" class="control-label col-md-3 col-sm-3 col-xs-12">
                <label for="state" class="control-label"><i class="fa fa-plus" aria-hidden="true"></i> {{trans('modules.mod_features_sizes_add')}} </label>
            </a>            
        </div>

        <div  id="inputSizes">
            <div id="size1Container" class="form-group">
                <label for="sizes" class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('modules.mod_features_size_title')}}<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="size1" type="text" name="sizes[]" class="form-control col-md-7 col-xs-12" maxlength="255" required>
                </div>
            </div>
        </div>

        <div class="ln_solid"></div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                <button type="submit" class="btn btn-success">{{trans('config.app_create')}}</button>
            </div>
        </div>
      
    </div>
</form>


<script>

    let sizesCount = 1;
    let sizesContainer = document.getElementById("inputSizes");
    
    document.getElementById("btnAddSize").addEventListener("click", function(e){
        e.preventDefault();

   
        sizesCount++;
        let divContainer = document.createElement("div");
        divContainer.id = "size"+sizesCount+"Container";
        divContainer.className = "form-group";

        let label = document.createElement("label");
        label.innerHTML = "{{ trans('modules.mod_features_size_title') }} *";
        label.className = "control-label col-md-3 col-sm-3 col-xs-12";
        divContainer.appendChild(label);

        let divInput =  document.createElement("div");
        divInput.className = "col-md-6 col-sm-6 col-xs-12";

        let input = document.createElement("input");
        input.type = "text";
        input.id = "size"+sizesCount;
        input.name = "sizes[]";
        input.className = "form-control col-md-7 col-xs-12";
        input.required = true;
        divInput.appendChild(input);
//<a class="deleteImg"><i class="fa fa-trash"></i></a>
        let btnRemove = document.createElement("a");
        btnRemove.className = "deleteImg";
        btnRemove.innerHTML = "<i class='fa fa-trash'></i>";
        btnRemove.addEventListener("click", function(e){
            e.preventDefault();
            divContainer.parentElement.removeChild(divContainer);
        });


        divContainer.appendChild(divInput);
        divContainer.appendChild(btnRemove);
        sizesContainer.appendChild(divContainer);

    });

</script>

@endsection