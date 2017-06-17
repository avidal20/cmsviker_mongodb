<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class ProductKidsSelected extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected  $collection = 'md_products_kids_selected';

    public function md_products_kids()
    {
        return $this->hasMany('App\ProductKids', 'id_product_kids', '_id');
    }

 	public function md_product()
    {
        return $this->belongsTo('App\Products', 'id_product', '_id');
    }
}
