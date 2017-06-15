<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class ProductsFeatures extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected  $collection = 'md_products_features';

    public function md_products()
    {
        return $this->hasMany('App\Products', 'id_product', '_id');
    }

    public function md_imgs()
    {
        return $this->hasMany('App\ProductFeacturesImgs', 'id_product_feature', '_id');
    }
}
