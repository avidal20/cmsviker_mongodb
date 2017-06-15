<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class Features_size extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected  $collection = 'md_features_sizes';

    public function md_features_sizes()
    {
        return $this->belongsTo('App\Features_sizes_category', 'id_md_features_sizes_category', 'id');
    }

    public function md_products()
    {
        return $this->hasMany('App\Products', 'type_size', 'id_md_features_sizes_category');
    }
    
}
