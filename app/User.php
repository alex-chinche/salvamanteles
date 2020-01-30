<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Token;
use App\Application;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'email', 'password', 'changed'
    ];

    public function profiles()
    {
        return $this->hasMany('App\Profile', 'user_id', 'id');
    }

    public function register(Request $request)
    {
        try {
            $user = new self();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->changed = 0;
            $user->save();
    
            return $this->getTokenFromUser($user);        
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "email already used"
            ], 401);
       }
    }
    public function login(Request $request)
    {
        try {
            $user = self::where('email', $request->email)->first();
           if (Hash::check($request->password, $user->password))
           {
            return $this->getTokenFromUser($user);
           } else {
            return response()->json([
                'message' => "wrong data"
            ], 401);
           }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "wrong data"
            ], 401);
        }
        
    }

    public function recover_password(Request $request)
    {
        try {
            $user = users::where('email', $request->email)->first();
            if ($user == null) {
                return response()->json([
                    'message' => "email not found"
                ], 401);
            } else  {
                $new_password = str_random(8);
                $hashed_random_password = Hash::make($new_password);
                users::where('id', $user->id)->update(['password' => $hashed_random_password]);
                users::where('id', $user->id)->update(['changed' => ($user->changed + 1)]);

                $to      = 'alex_rodriguez_apps1ma1819@cev.com'; //$user->email;
                $subject = 'password reset bienestapp';
                $message = 'the new password is: ' . $new_password;
                $headers = 'From: alex_rodriguezrealnofake@cev.com' . "\r\n" .
                    'Reply-To: ' . $to . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                
                mail($to, $subject, $message, $headers);

                return $new_password;

            }

           
       } catch (\Throwable $th) {
            return response()->json([
                'message' => "email not found"
            ], 401);
        }
        


    }
    
    private function getTokenFromUser($user)
    {
        $token_inv = new Token();
        $token = $token_inv->encode_token($user->email, $user->changed);
        return response()->json([
           'token' => $token
        ], 200);
    }

    public function get_logged_user(Request $request)
    {
        $token_inv = new Token();
        $coded_token = $request->header('token');
        $decoded_token = $token_inv->decode_token($coded_token);
        $user = users::where('email', $decoded_token[0])->first();
        return $user;
    }




}
