<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator; 
use Hash; 
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\BlogModel;
use Auth;
class UsersController extends Controller
{ 
    public $UserModel;
    public $BlogModel;
    
    public function __construct(){
        $this->UserModel = new User;
        $this->BlogModel = new BlogModel;
    }
 
    public function login(Request $request) {
        try {
           
            return view('user.login');
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }

    

    public function UserLogin(Request $request) {
        try {
            $validate = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required'
                ],[  
                "email.required" => "Email required.",
                "email.email" => "Enter a valid email address.",
                "password.required" => "Password required.",
            ]);
            $login_route = route('login');
            $user_home_route = route('user-home');
            
            if($validate->fails()){
                return redirect($login_route)->withErrors($validate->errors())->withInput();
            }
            $email = trim($request->post('email'));
            $password = $request->post('password');

            $GetUserByEmail = $this->UserModel->GetRowByEmail($email);
            if(!$GetUserByEmail['result']){
                return redirect($login_route)->with('failed_','These credentials do not match our records.')->withInput();
            } 
            if($GetUserByEmail['data']->user_role_id !==2){
                return redirect($login_route)->with('failed_','Invalid user role.')->withInput();
            }
             
            $user = $GetUserByEmail['data'];
            if(!Hash::check($password, $user->password)) {
                return redirect($login_route)->with('failed_','Login Failed.')->withInput();
            }
            $request->session()->forget('user_data');
            $request->session()->put('user_data',$user);
            Auth::login(User::find($GetUserByEmail['data']->id));
            return redirect($user_home_route)->with('success_','Successfully logged in');
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }





    public function Register(Request $request) {
        try {
           
            return view('user.register');
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }

    public function UserRegister(Request $request) {
        try {
            $validate = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10|unique:users',
                'password' => 'required|min:6|max:10'
                ],[  
                "name.required" => "Name required.",
                "email.required" => "Email required.",
                "email.email" => "Enter a valid email address.",
                "email.unique" => "The email already exists.",
                "phone.required" => "Phone no required.",
                "phone.regex" => "Enter a valid phone number.",
                "phone.digits" => "The phone no must be 10 digit.",
                "password.required" => "Password required.",
                "password.min" => "Password greater than 6 characters.",
                "password.max" => "Password less than 10 characters.",
            ]); 
            $register_route = route('register');
            $login_route = route('login');
            if($validate->fails()){ 
                return redirect($register_route)->withErrors($validate->errors())->withInput();
            }
             
            $data = $this->UserModel->UserRegister($request);
            if(!$data['resulte']){
                throw new \Exception('Failed to create. Please try again after some time.');
            }
            return redirect($login_route)->with('success_','Account has been successfully created. Please Login. Id- '.$data['user']->id);
            
        } catch (\Throwable $error) {
          
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }




    public function UserHome(Request $request) {
        try {
            
            return view('user.index');
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }
 
    public function ShowUserProfile(Request $request) {
        try {
            $login_user = session()->get('user_data'); 
            $user_details = GetRowById($login_user->id);
            $user_details = $user_details['data'];

            $data = array(
                'user_details'=>$user_details
            );
            return view('user.user-profile',$data);
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }
 

    public function UpdatePersonalDetails(Request $request) {
        try {
            if($request->hasFile('photo')) {
                $validate = Validator::make($request->all(),[
                    'name' => 'required|max:250',
                    'photo' => ['required','image','mimes:jpeg,png,jpg', 'max:500'],
                    ],[ 
                    "name.required" => "Name required.",
                    "name.max" => "Name should 250 characters.",
                    "photo.required" => "Blog image required.",
                    "photo.image" => "Allow only image.",
                    "photo.max" => "Image size should be size less than 500 kb",
                    "photo.mimes" => "Please select jpg, png file..!!",
                ]);
            } else {
                $validate = Validator::make($request->all(),[
                    'name' => 'required|max:250',
                    ],[ 
                    "name.required" => "Name required.",
                    "name.max" => "Name should 250 characters.",
                ]);
            }
            $user_profile_route = route('user-profile');
            if($validate->fails()){ 
                return redirect($user_profile_route)->withErrors($validate->errors())->withInput();
            } 
            $login_user = session()->get('user_data');
            $name =  trim($request->post('name'));
            $user_details = GetRowById($login_user->id);
            $user = $user_details['data'];
            $file_Newname ="";
            if($request->hasFile('photo')) {
                if(!getimagesize($_FILES['photo']['tmp_name'])){
                    return redirect($user_profile_route)->with('ad_danger1','Invalid file selected. Try again.');
                }
                $file = $request->file('photo');
                $fileName = $file->getClientOriginalName();
                $file_extension = $file->extension();
                $file_size = $file->getSize();
                $file_Newname = "users-".rand(11111, 99999).".".$file_extension;
                if($file->move('public/users/',$file_Newname)){
                    $data_collection = array(
                        'id'=>$user->id,
                        'name'=>$name,
                        'photo'=>$file_Newname,
                    );
                    $data = $this->UserModel->UpdatePersonalDetails($request,$data_collection);
                    if(!$data['resulte']){
                        throw new \Exception('Failed to update. Please try again after some time.');
                    }
                    if(!empty($user->photo)){
                        $oldPath = public_path("users/".$user->photo);
                        if (\File::exists($oldPath)){
                            \File::delete($oldPath);
                        }
                    }
                    return redirect($user_profile_route)->with('ad_massage1','Personal details successfully updated.');
                } else {
                  return redirect($user_profile_route)->with('ad_danger1','Failed to upload profile photo. Try after some time.');
                }
            } else {
                $data_collection = array(
                    'id'=>$user->id,
                    'name'=>$name,
                    'photo'=>$user->photo,
                );
                $data = $this->UserModel->UpdatePersonalDetails($request,$data_collection);
                if(!$data['resulte']){
                    throw new \Exception('Failed to update. Please try again after some time.');
                }
                return redirect($user_profile_route)->with('ad_massage1','Successfully updated.');
            }
        } catch (\Throwable $error) {
            $Path = public_path("users/".$file_Newname);
            if (\File::exists($Path)){
                \File::delete($Path);
            }
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }

    
    
    public function UpdateEmail(Request $request) {
        try {
            $login_user = session()->get('user_data');
            $validate = Validator::make($request->all(),[
                'email' => 'required|email|unique:users,email,'.$login_user->id.',id',
                ],[ 
                "email.required" => "Email required.",
                "email.email" => "Enter a valid email address.",
                "email.unique" => "The email already exists.",
            ]);
            $user_profile_route = route('user-profile');
            if($validate->fails()){ 
                return redirect($user_profile_route)->withErrors($validate->errors())->withInput();
            } 
            
            $email =  trim($request->post('email'));
            $data_collection = array(
                'id'=>$login_user->id,
                'email'=>$email,
            );
            $data = $this->UserModel->UpdateEmail($request,$data_collection);
            if(!$data['resulte']){
                throw new \Exception('Failed to update email. Please try again after some time.');
            }
            return redirect($user_profile_route)->with('ad_massage2','Email successfully updated.');
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }


    public function UpdatePhone(Request $request) {
        try {
            $login_user = session()->get('user_data');
            $validate = Validator::make($request->all(),[
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10|unique:users,phone,'.$login_user->id.',id',
                ],[ 
                "phone.required" => "Phone number required.",
                "phone.regex" => "Enter a valid phone number.",
                "phone.digits" => "The phone no should be 10 digit.",
                "phone.unique" => "The number number already exists.",
            ]);
            $user_profile_route = route('user-profile');
            if($validate->fails()){ 
                return redirect($user_profile_route)->withErrors($validate->errors())->withInput();
            } 
            
            $phone =  trim($request->post('phone'));
            $data_collection = array(
                'id'=>$login_user->id,
                'phone'=>$phone, 
            );
            $data = $this->UserModel->UpdatePhone($request,$data_collection);
            if(!$data['resulte']){
                throw new \Exception('Failed to update phone number. Please try again after some time.');
            }
            return redirect($user_profile_route)->with('ad_massage4','Phone number successfully updated.');
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }



    public function UpdatePassword(Request $request) {
        try {
            $validate = Validator::make($request->all(),[
                'password' => 'required',
                'new_password' => 'required|min:6|max:10',
                ],[ 
                "password.required" => "Password required.",
                "new_password.required" => "New password required.",
                "new_password.min" => "New password greater than 6 characters.",
                "new_password.max" => "New password less than 10 characters.",
            ]);
            $user_profile_route = route('user-profile');
            if($validate->fails()){  
                return redirect($user_profile_route)->withErrors($validate->errors())->withInput();
            } 
            $login_user = session()->get('user_data');
            $register_route = route('register');
            $login_route = route('login');
            $password =  $request->post('password');
            $new_password =  $request->post('new_password');
            $get_user_data = $this->UserModel->GetRowById($login_user->id);
            if($get_user_data['total_rows'] <= 0){
                $request->session()->forget('user_data'); 
                Auth::logout();
                return redirect($login_route)->with('failed_','User not found.');
            }
            $user = $get_user_data['data'];
            if(!Hash::check($password, $user->password)) {
                return redirect($user_profile_route)->with("ad_danger3','Current password doesn't match.");
            }

            $data_collection = array(
                'id'=>$user->id,
                'new_password'=>Hash::make($new_password), 
            );
            $data = $this->UserModel->UpdatePassword($request,$data_collection);
            if(!$data['resulte']){
                throw new \Exception('Failed to update password. Please try again after some time.');
            }
            $request->session()->forget('user_data'); 
            Auth::logout();
            return redirect($login_route)->with('success_','Password has been successfully updated. Please login.');
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }



    public function UserLogout(Request $request) {
        try {
            $register_route = route('register');
            $login_route = route('login');
            $request->session()->forget('user_data');
            Auth::logout();
            return redirect($login_route)->with('success_','Successfully logged out');
            
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }

 
    








}
