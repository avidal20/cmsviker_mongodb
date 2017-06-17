<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class ProductKids extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected  $collection = 'md_products_kids';

    public function md_category()
    {
        return $this->belongsTo('App\Categories', 'category', '_id');
    }

}
