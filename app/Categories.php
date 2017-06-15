<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class Categories extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected  $collection = 'md_categories';

    public function md_products()
    {
        return $this->hasMany('App\Products', 'category', '_id');
    }
}
