<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';

    protected $fillable = [
        'name', 'icon',
    ];

    public function restaurants()
    {
        return $this->belongsToMany('App\Dish', 'restaurants_offering_dishes', 'restaurant_id', 'dish_id');
    }




    public function register(Request $request)
    {
        try {
            $restaurant = new self();
            $restaurant->name = $request->name;
            $restaurant->save();
              
            return response()->json([
               200
            ], 200);       
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "wrong data"
            ], 401);
       }
    

    }


}
