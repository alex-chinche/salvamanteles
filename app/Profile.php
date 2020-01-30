<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profile extends Model
{

    protected $table = 'profiles';

    protected $fillable = [
        'name', 'user_id',
    ];
    public $timestamps = false;

    public function users(){
        return $this->belongsTo('App\users', 'user_id');
}

public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient', 'profiles_choosing_ingredients', 'profile_id', 'ingredient_id');
    }

    



public function register(Request $request)
    {
        try {
            $profile = new self();
            $profile->name = $request->name;
            $user_inv = new User();
            $user = $user_inv->get_logged_user();
            $profile->user_id = $user->id;
            $profile->save();
              
            return response()->json([
                'profile_id' => $profile->id
            ], 200);       
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "wrong data"
            ], 401);
       }
    

    }

    /*public function show_user_apps(Request $request)
    {
         
        $user = $this->get_logged_user($request);

        $data = DB::select('select apps.* from apps, has_relation where has_relation.user_id = ' . $user->id . ' and has_relation.app_id = apps.id');

        return $data;
 

    }*/




}
