<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class ProductSize extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected  $collection = 'md_products_sizes';

    public function md_features_size()
    {
        return $this->belongsTo('App\Features_size', 'id_size', '_id');
    }
}
