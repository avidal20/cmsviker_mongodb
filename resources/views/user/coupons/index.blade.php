@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ingresar cup&oacute;n</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="#">
                    	<fieldset disabled="">
                    		
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('coupon') ? ' has-error' : '' }}">
                            <label for="coupon" class="col-md-4 control-label">{{ trans('auth.field_coupon') }}</label>

                            <div class="col-md-6">
                                <input id="coupon" type="text" class="form-control" name="coupon" value="{{ old('coupon') }}" required autofocus>

                                @if ($errors->has('coupon'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('coupon') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('auth.btn_accept') }}
                                </button>

                                <a class="btn btn-link" href="#">
                                    {{ trans('auth.list_orders') }}
                                </a>
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
