<!-- footer content -->
        <footer>
          <div class="pull-right">
            ParcheGato
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- jQuery custom content scroller -->
    <script src="{{ asset('vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- jQuery Tags Input -->
    <script src="{{ asset('vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- Parsley -->
    <script src="{{ asset('vendors/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ asset('vendors/parsleyjs/dist/i18n/es.js') }}"></script>
    <!-- Autosize -->
    <script src="{{ asset('vendors/autosize/dist/autosize.min.js') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('build/js/custom.min.js') }}"></script>

    @if(isset($plugins))
        @foreach($plugins as $plugin)

            @if(is_array(config('plugins.'.$plugin.'.js')))
                @foreach(config('plugins.'.$plugin.'.js') as $pluginArray)
                  <script src="{!! asset($pluginArray) !!}"></script>
                @endforeach
            @else
              <script src="{!! asset(config('plugins.'.$plugin.'.js')) !!}"></script>
            @endif

            @if(!empty(config('plugins.'.$plugin.'.useJs')))
                <script type="text/javascript">
                  {!! config('plugins.'.$plugin.'.useJs') !!}
                </script>
            @endif

        @endforeach
    @endif
    
    @yield('js')

  </body>
</html>
