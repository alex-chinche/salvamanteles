<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Ingredient extends Model
{
    protected $table = 'ingredients';

    protected $fillable = [
        'name',
    ];

    public function profiles()
    {
        return $this->belongsToMany('App\Profile', 'profiles_choosing_ingredients', 'ingredient_id', 'profile_id');
    }

    public function families()
    {
        return $this->belongsToMany('App\Ingredient_Family', 'ingredients_from_family', 'ingredient_id', 'ingredient_family_id');
    }

    public function dishes()
    {
        return $this->belongsToMany('App\Dish', 'dishes_containing_ingredients', 'ingredient_id', 'dish_id');
    }



    public function register(Request $request)
    {
        try {
            $ingredient = new self();
            $ingredient->name = $request->name;
            $profile->save();
              
            return response()->json([200
            ], 200);       
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "wrong data"
            ], 401);
       }
    

    }


    public function assign_family(Request $request) {


        try {

            $ingredient = self::find($request->ingredient_id);

            $ingredient->families()->attach($request->family_id);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "wrong data"
            ], 401);
        }
    }

    public function assign_dish(Request $request) {


        try {

            $ingredient = self::find($request->ingredient_id);

            $ingredient->dishes()->attach($request->dish_id);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "wrong data"
            ], 401);
        }
    }

    public function rename(Request $request)
    {
        try {

            $affected = DB::table('ingredients')
            ->where('id', $request->ingredient_id)
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

    public function change_family(Request $request)
    {
        try {

            $affected = DB::table('ingredients')
            ->where('id', $request->ingredient_id)
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




    public function remove_family(Request $request)
    {
        try {

            $this->find($request->ingredient_id)->families()->delete();
           
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
