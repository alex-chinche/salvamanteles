<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $table = 'dishes';

    protected $fillable = [
        'name', 'type',
    ];

    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient', 'dishes_containing_ingredients', 'dish_id', 'ingredient_id');
    }

    public function restaurants()
    {
        return $this->belongsToMany('App\Restaurant', 'restaurants_offering_dishes', 'dish_id', 'restaurant_id');
    }

    public function assign_restaurant(Request $request) {


        try {

            $dish = self::find($request->dish_id);

            $dish->dishes()->attach($request->restaurant_id);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "wrong data"
            ], 401);
        }
    }
    
}
