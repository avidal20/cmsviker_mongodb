@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('modules.mod_pqr') }}</div>
                <div class="panel-body">
                    <form id="form" class="form-horizontal" role="form" method="POST" action="{{route('pqr.user.store')}}" enctype="multipart/form-data">
                    	<fieldset>
                    		
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('coupon_affected') ? ' has-error' : '' }}">
                            <label for="coupon_affected" class="col-md-4 control-label">{{ trans('modules.mod_pqr_field_coupon_affected') }} *</label>

                            <div class="col-md-6">
                                <input id="coupon_affected" type="text" class="form-control" name="coupon_affected" value="{{ old('coupon_affected') }}" required autofocus>

                                @if ($errors->has('coupon_affected'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('coupon_affected') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type_request') ? ' has-error' : '' }}">
                            <label for="type_request" class="col-md-4 control-label">{{ trans('modules.mod_pqr_field_type_request') }} *</label>

                            <div class="col-md-6">
                                <select id="type_request" class="form-control" name="type_request" required autofocus>
                                    <option value="">Seleccionar</option>
                                    @foreach($type_pqr as $type)
                                        <option value="{{ $type->type }}" @if(old('type_request') == $type->type) selected @endif>{{ $type->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('type_request'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_request') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description_request') ? ' has-error' : '' }}">
                            <label for="description_request" class="col-md-4 control-label">{{ trans('modules.mod_pqr_field_description_request') }} *</label>

                            <div class="col-md-6">
                                <textarea id="description_request" name="description_request" class="form-control" required autofocus>{{ old('description_request') }}</textarea>

                                @if ($errors->has('description_request'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_request') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @for($i = 0; $i < 3; $i++)
                        <div class="form-group{{ $errors->has('anexo.'.$i) ? ' has-error' : '' }}">
                            <label for="anexo{{$i}}" class="col-md-4 control-label">{{ trans('modules.mod_pqr_field_anexo')." ".$i }}</label>

                            <div class="col-md-6">
                                <input id="anexo{{$i}}" type="file" name="anexo[]" value="{{ old('anexo') }}" autofocus accept=".jpg,.png,.pdf,.zip">

                                @if ($errors->has('anexo.'.$i))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('anexo.'.$i) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endfor

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                {!! Recaptcha::render() !!}
                                 @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-5">
                                <input type="submit" class="btn btn-primary" value="{{ trans('config.app_send') }}">
                            </div>
                        </div>
                        
                    	</fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){

        $( "#form" ).validate({
            rules: {
                coupon_affected:{
                    required: true,
                    maxlength: 255
                },
                type_request:{
                    required: true,
                    maxlength: 1,
                    number:true
                },
                description_request:{
                    required: true,
                    maxlength: 550
                },
                "anexo[]": {
                  accept: 'application/pdf,image/jpeg,image/png,application/zip,application/x-compressed,application/x-zip-compressed,multipart/x-zip'
                }
          },
          messages: {
                coupon_affected: {
                    required: "Este campo es requerido.",
                    maxlength: "Por favor, introduzca no más de 255 caracteres." 
                },
                type_request:{
                    required: "Este campo es requerido.",
                    maxlength: "Por favor, introduzca no más de 1 caracteres.",
                    number:"Por favor, introduzca un numero entero valido."
                },
                description_request:{
                    required: "Este campo es requerido.",
                    maxlength: "Por favor, introduzca no más de 550 caracteres."
                },
                "anexo[]": {
                  accept: 'Introduzca un archivo con un tipo de válido (jpg, png, pdf, zip)'
                }
            }
        });
    });
</script>
@endsection