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

}
