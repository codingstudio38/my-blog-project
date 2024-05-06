<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Hash;

class AuthController extends Controller
{

    
// public function __construct(){ 
//    $this->middleware('auth:api', ['except' => ['login','register']]);
// } 
  


public function Register(Request $request)
{
    try {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10|unique:users',
            'password' => 'required|min:6|max:12',
        ],
        [ 
            "name.required" => "Name required.",
            "email.required" => "Email required.",
            "email.email" => "The email must be a valid email address.",
            "email.unique" => "The email already exists.",
            "phone.required" => "Phone no required.",
            "phone.regex" => "The phone no must be a valid phone number.",
            "phone.digits" => "The phone no must be 10 digit.",
            "password.required" => "Password required.",
            "password.min" => "Password greater than 6 digit.",
            "password.max" => "Password less than 12 digit.",
        ]);
      
        if ($validator->fails())
        {
            $datais = array(
                'message'=>'Ivalid data format.',
                'error'=>$validator->errors(),
                'status'=>false,
            );
            return response()->json($datais,400);
        } 

       $name = trim($request->post('name'));
       $email = trim($request->post('email'));
       $phone = trim($request->post('phone'));
       $password = $request->post('password');
        $user = new User;
        $user->name=$name;
        $user->email=$email;
        $user->phone=$phone;
        $user->user_role_id=2;
        $user->password=Hash::make($password);
        if(!$user->save()){
            throw new \Exception("Failed to create account. Please try again after some time.");
        }
        $datais = array(
            'message'=>'Successfully created.',
            'error'=>"",
            'user'=>$user,
            'status'=>true,
        );
        return response()->json($datais,200);

    } catch (\Throwable $error) {
      $erroris = array(
        'message'=>$error->getMessage(),
        'error'=>$error,
        'status'=>false,
      );
      return response()->json($erroris, 400); 
    }
    
}


public function Login(Request $request)
{
    try {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|',
        ],
        [ 
            "email.required" => "Email required.",
            "email.email" => "The email must be a valid email address.",
            "password.required" => "Password required.",
        ]);
      
        if ($validator->fails())
        {
            $datais = array(
                'message'=>'Ivalid data format.',
                'error'=>$validator->errors(),
                'status'=>false,
            );
            return response()->json($datais,400);
        } 
 
       $email = trim($request->post('email'));
       $password = $request->post('password');
        //  $credentials = request(['email', 'password']);
       $token=auth()->attempt($validator->validated());
       if(!$token){ 
            $datais = array(
                'message'=>'Invalid credentials provided',
                'error'=>"failed",
                'status'=>false,
            );
            return response()->json($datais,401);
       }
        
        $datais = array(
            'message'=>'Successfully logged in.',
            'error'=>"",
            'user'=>auth()->user(),
            'token'=>$this->createNewToken($token),
            'status'=>true,
        );
        return response()->json($datais,200);

    } catch (\Throwable $error) {
      $erroris = array(
        'message'=>$error->getMessage(),
        'error'=>$error,
        'status'=>false,
      );
      return response()->json($erroris, 400); 
    }
}



public function createNewToken($token)
{
    return array(
        //'expires_in'=>auth()->factory()->getTTL()*60*4,
        'access_token'=>$token,
        'token_type'=>'bearer',
    );
}

public function Profile(Request $request)
{
    try {
         $datais = array(
        'message'=>'User Data.',
        'error'=>"",
        'user'=>auth()->user(),
        'status'=>true, 
        );
        return response()->json($datais,200);
    } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

        return response()->json(['token_expired'], 400);

    } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

        return response()->json(['token_invalid'], 400);

    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        return response()->json(['token_absent' => $e->getMessage()], 400);
    } catch (Exception $e) {
        $erroris = array(
        'message'=>$error->getMessage(),
        'error'=>$error,
        'status'=>false,
      );
      return response()->json($erroris, 400);  
    }
   
}
public function refresh()
{
    try {
        return response()->json([
            'message' => 'success',
            'user' => Auth::user(),
            'status'=>true,
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

        return response()->json(['token_expired'], 400);

    } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

        return response()->json(['token_invalid'], 400);

    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        return response()->json(['token_absent' => $e->getMessage()], 400);
    } catch (Exception $e) {
        $erroris = array(
        'message'=>$error->getMessage(),
        'error'=>$error,
        'status'=>false,
      );
      return response()->json($erroris, 400); 
    }
}

public function Logout(Request $request)
{
    try {
         $datais = array(
            'message'=>'User successfully logged out.',
            'error'=>"",
            'user'=>auth()->logout(),
            'status'=>true,
        );
        return response()->json($datais,200);
    } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

        return response()->json(['token_expired'], 400);

    } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

        return response()->json(['token_invalid'], 400);

    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        return response()->json(['token_absent' => $e->getMessage()], 400);
    } catch (Exception $e) {
        $erroris = array(
        'message'=>$error->getMessage(),
        'error'=>$error,
        'status'=>false,
      );
      return response()->json($erroris, 400); 
    }
   
}



}
