<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class Features_sizes_category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected  $collection = 'md_features_sizes_category';

    public function md_features_sizes()
    {
        return $this->hasMany('md_features_sizes');
    }
}
