@extends('admin.layoutAdminModule')

@section('title', trans('config.mod_users_desc'))

@section('content')

<form id="form-obj" data-parsley-validate="" novalidate="" method="post" action="{{ route('users.permissions.update',['id' => $user->id ]) }}">
      
      {{ csrf_field() }}
      {{ method_field('PUT') }}

      <div class="x_content">
       <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
          <div class="panel">
             <a class="panel-heading collapsed" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="false" aria-controls="collapseOne">
                <h4 class="panel-title">{{ trans('config.mod_categories_name') }}</h4>
             </a>
             <div id="collapseOne1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                   <div class="checkbox">
                      <label class="">
                         <div class="icheckbox_flat-green" style="position: relative;"><input id="userAll" type="checkbox" @if($user->hasRole('category.all')) checked="checked" @endif name="perm[category][all]" class="flat" style="position: absolute; opacity: 0;"><ins id="insUserAll" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                         Todo
                      </label>
                   </div>
                   <div class="checkbox">
                      <label class="">
                         <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields0" type="checkbox"  @if($user->hasRole('category.list')) checked="checked" @endif name="perm[category][list]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                         Listar
                      </label>
                   </div>
                   <div class="checkbox">
                      <label class="">
                         <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields1" type="checkbox"  @if($user->hasRole('category.create')) checked="checked" @endif name="perm[category][create]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                         Crear
                      </label>
                   </div>
                   <div class="checkbox">
                      <label class="">
                         <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields2" type="checkbox" @if($user->hasRole('category.update')) checked="checked" @endif name="perm[category][update]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                         Modificar
                      </label>
                   </div>
                   <div class="checkbox">
                      <label class="">
                         <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields3" type="checkbox"  @if($user->hasRole('category.delete')) checked="checked" @endif name="perm[category][delete]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                         Eliminar
                      </label>
                   </div>
                </div>
             </div>
          </div>

          <div class="panel">
             <a class="panel-heading collapsed" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#features" href="#features" aria-expanded="false" aria-controls="collapseOne">
                <h4 class="panel-title">{{ trans('config.mod_features_name') }}</h4>
             </a>
             <div id="features" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                   
                  <div class="panel">
                 <a class="panel-heading collapsed" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#sizes" href="#sizes" aria-expanded="false" aria-controls="collapseOne">
                    <h4 class="panel-title">{{ trans('modules.mod_features_sizes_title') }}</h4>
                 </a>
                 <div id="sizes" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="userAll" type="checkbox" @if($user->hasRole('sizes.all')) checked="checked" @endif name="perm[sizes][all]" class="flat" style="position: absolute; opacity: 0;"><ins id="insUserAll" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Todo
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields0" type="checkbox"  @if($user->hasRole('sizes.list')) checked="checked" @endif name="perm[sizes][list]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Listar
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields1" type="checkbox"  @if($user->hasRole('sizes.create')) checked="checked" @endif name="perm[sizes][create]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Crear
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields2" type="checkbox" @if($user->hasRole('sizes.update')) checked="checked" @endif name="perm[sizes][update]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Modificar
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields3" type="checkbox"  @if($user->hasRole('sizes.delete')) checked="checked" @endif name="perm[sizes][delete]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Eliminar
                          </label>
                       </div>
                    </div>
                 </div>
              </div>

                <div class="panel">
                 <a class="panel-heading collapsed" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#colors" href="#colors" aria-expanded="false" aria-controls="collapseOne">
                    <h4 class="panel-title">{{ trans('modules.mod_features_colors_title') }}</h4>
                 </a>
                 <div id="colors" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="userAll" type="checkbox" @if($user->hasRole('colors.all')) checked="checked" @endif name="perm[colors][all]" class="flat" style="position: absolute; opacity: 0;"><ins id="insUserAll" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Todo
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields0" type="checkbox"  @if($user->hasRole('colors.list')) checked="checked" @endif name="perm[colors][list]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Listar
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields1" type="checkbox"  @if($user->hasRole('colors.create')) checked="checked" @endif name="perm[colors][create]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Crear
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields2" type="checkbox" @if($user->hasRole('colors.update')) checked="checked" @endif name="perm[colors][update]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Modificar
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields3" type="checkbox"  @if($user->hasRole('colors.delete')) checked="checked" @endif name="perm[colors][delete]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Eliminar
                          </label>
                       </div>
                    </div>
                 </div>
              </div>

                </div>
             </div>
          </div>
          
          <div class="panel">
             <a class="panel-heading collapsed" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#productsGroup" href="#productsGroup" aria-expanded="false" aria-controls="collapseOne">
                <h4 class="panel-title">{{ trans('config.mod_products_name') }}</h4>
             </a>
             <div id="productsGroup" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                   
                  <div class="panel">
                 <a class="panel-heading collapsed" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#product" href="#product" aria-expanded="false" aria-controls="collapseOne">
                    <h4 class="panel-title">{{ trans('config.mod_products_name') }}</h4>
                 </a>
                 <div id="product" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="userAll" type="checkbox" @if($user->hasRole('products.all')) checked="checked" @endif name="perm[products][all]" class="flat" style="position: absolute; opacity: 0;"><ins id="insUserAll" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Todo
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields0" type="checkbox"  @if($user->hasRole('products.list')) checked="checked" @endif name="perm[products][list]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Listar
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields1" type="checkbox"  @if($user->hasRole('products.create')) checked="checked" @endif name="perm[products][create]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Crear
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields2" type="checkbox" @if($user->hasRole('products.update')) checked="checked" @endif name="perm[products][update]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Modificar
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields3" type="checkbox"  @if($user->hasRole('products.delete')) checked="checked" @endif name="perm[products][delete]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Eliminar
                          </label>
                       </div>
                    </div>
                 </div>
              </div>

                <div class="panel">
                 <a class="panel-heading collapsed" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#kids" href="#kids" aria-expanded="false" aria-controls="collapseOne">
                    <h4 class="panel-title">{{ trans('config.mod_kids_name') }}</h4>
                 </a>
                 <div id="kids" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="userAll" type="checkbox" @if($user->hasRole('kids.all')) checked="checked" @endif name="perm[kids][all]" class="flat" style="position: absolute; opacity: 0;"><ins id="insUserAll" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Todo
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields0" type="checkbox"  @if($user->hasRole('kids.list')) checked="checked" @endif name="perm[kids][list]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Listar
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields1" type="checkbox"  @if($user->hasRole('kids.create')) checked="checked" @endif name="perm[kids][create]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Crear
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields2" type="checkbox" @if($user->hasRole('kids.update')) checked="checked" @endif name="perm[kids][update]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Modificar
                          </label>
                       </div>
                       <div class="checkbox">
                          <label class="">
                             <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields3" type="checkbox"  @if($user->hasRole('kids.delete')) checked="checked" @endif name="perm[kids][delete]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                             Eliminar
                          </label>
                       </div>
                    </div>
                 </div>
              </div>

                </div>
             </div>
          </div>

          <div class="panel">
             <a class="panel-heading collapsed" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#groups" href="#groups" aria-expanded="false" aria-controls="collapseOne">
                <h4 class="panel-title">{{ trans('config.mod_groups_name') }}</h4>
             </a>
             <div id="groups" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                   <div class="checkbox">
                      <label class="">
                         <div class="icheckbox_flat-green" style="position: relative;"><input id="userAll" type="checkbox" @if($user->hasRole('groups.all')) checked="checked" @endif name="perm[groups][all]" class="flat" style="position: absolute; opacity: 0;"><ins id="insUserAll" class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                         Todo
                      </label>
                   </div>
                   <div class="checkbox">
                      <label class="">
                         <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields0" type="checkbox"  @if($user->hasRole('groups.list')) checked="checked" @endif name="perm[groups][list]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                         Listar
                      </label>
                   </div>
                   <div class="checkbox">
                      <label class="">
                         <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields1" type="checkbox"  @if($user->hasRole('groups.create')) checked="checked" @endif name="perm[groups][create]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                         Crear
                      </label>
                   </div>
                   <div class="checkbox">
                      <label class="">
                         <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields2" type="checkbox" @if($user->hasRole('groups.update')) checked="checked" @endif name="perm[groups][update]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                         Modificar
                      </label>
                   </div>
                   <div class="checkbox">
                      <label class="">
                         <div class="icheckbox_flat-green" style="position: relative;"><input id="user_fields3" type="checkbox"  @if($user->hasRole('groups.delete')) checked="checked" @endif name="perm[groups][delete]" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                         Eliminar
                      </label>
                   </div>
                </div>
             </div>
          </div>
        </div>

      <div class="form-group">
         <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
            <button type="submit" class="btn btn-success">{{trans('config.app_save')}}</button>
         </div>
      </div>
      
   </div>
</form>

@endsection