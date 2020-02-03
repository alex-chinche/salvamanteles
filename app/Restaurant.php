<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
            $restaurant->icon = $request->icon;
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


    public function rename(Request $request)
    {
        try {

            $affected = DB::table('restaurants')
            ->where('id', $request->restaurant_id)
            ->update(['name' => $request->name]);
              
            return response()->json([
               200
            ], 200);       
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "wrong data"
            ], 401);
       }
    

    }

    public function change_icon(Request $request)
    {
        try {

            $affected = DB::table('restaurants')
            ->where('id', $request->restaurant_id)
            ->update(['icon' => $request->icon]);
              
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
