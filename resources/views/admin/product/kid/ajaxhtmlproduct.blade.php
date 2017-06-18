<div class="row">
  @if ( count($kid->md_products)>0 )
    @foreach($kid->md_products as $product)
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="row">
          <div class="col-md-4 col-sm-12 col-xs-12">
            <img src="{{ asset(str_replace('public','storage',$product->md_product->md_feactures[0]->md_imgs[0]->file)) }}" class="img-responsive img-rounded" style="width:100px;height:100px;">
          </div>
          <div class="col-md-8 col-sm-12 col-xs-12">
            <p><strong>Referencia:</strong> {{ $product->md_product->reference }}</p>    
            <p>{{ $product->md_product->name }}</p>    
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