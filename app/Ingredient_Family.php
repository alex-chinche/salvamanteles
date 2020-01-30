<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient_Family extends Model
{
    protected $table = 'ingredients_family';

    protected $fillable = [
        'name',
    ];

    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient', 'ingredients_from_family', 'ingredient_family_id' , 'ingredient_id');
    }


}
