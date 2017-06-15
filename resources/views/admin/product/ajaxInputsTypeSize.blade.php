<div class="form-group">
   <label name="education" class="col-md-3 col-sm-3 col-xs-12 control-label">Tallas*</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
      @foreach($sizes as $size)
		<div class="checkbox">
	    <label class="">
	      <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;" value="{{ $size->id }}" name="sizes[]"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> {{ $size->name }}
	    </label>
	  </div>
      @endforeach
   </div>
</div>

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
});
</script>