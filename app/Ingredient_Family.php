<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient_Family extends Model
{
    protected $table = 'ingredients_family';

    protected $fillable = [
        'name',
    ];
}
