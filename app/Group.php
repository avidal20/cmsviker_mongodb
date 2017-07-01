<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class Group extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected  $collection = 'md_groups';

    /*public function users()
    {
        return $this->hasMany('App\User', 'id_product_feature', '_id');
    }*/
}
