<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class Products extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected  $collection = 'md_products';
    
    public function md_category()
    {
        return $this->belongsTo('App\Categories', 'category', '_id');
    }

    public function md_size_category()
    {
        return $this->belongsTo('App\Features_sizes_category', 'type_size', '_id');
    }

    public function md_size()
    {
        return $this->hasMany('App\Features_size', 'id_md_features_sizes_category', 'type_size');
    }

    public function md_feactures()
    {
        return $this->hasMany('App\ProductsFeatures', 'id_product', '_id');
    }

    public function md_size_selected()
    {
        return $this->hasMany('App\ProductSize', 'id_product', '_id');
    }

}
