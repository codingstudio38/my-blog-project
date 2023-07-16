<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use \Hash;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function GetRowByEmail(string $emailid){
        try {
            DB::select("SET @p0='$emailid'");
            DB::select("SET @p1=''");
            DB::select("CALL `CountRowByEmail`(@p0, @p1)");
            $total_record = DB::select("SELECT @p1 AS `total_row`");
            if(count($total_record) <= 0){
                return array('result'=>false,'data'=>'','total_rows'=>$total_record);
            }
            $total = $total_record[0]->total_row;
            if($total <= 0){
                return array('result'=>false,'data'=>'','total_rows'=>$total);
            }
            $user_data = DB::select("CALL GetRowByEmail(?)",array($emailid));
            $user = $user_data[0];
            return array('result'=>true,'data'=>$user,'total_rows'=>$total);
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function GetRowById(int $id){
        try {
            DB::select("SET @p0='$id'");
            DB::select("SET @p1=''");
            DB::select("CALL `CountRowById`(@p0, @p1)");
            $total_record = DB::select("SELECT @p1 AS `total_row`");
            if(count($total_record) <= 0){
                return array('result'=>false,'data'=>'','total_rows'=>$total_record);
            }
            $total = $total_record[0]->total_row;
            if($total <= 0){
                return array('result'=>false,'data'=>'','total_rows'=>$total);
            }
            $user_data = DB::select("CALL GetRowById(?)",array($id));
            $user = $user_data[0];
            return array('result'=>true,'data'=>$user,'total_rows'=>$total);
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    public function UserRegister($request) {
        try {
            $name = trim($request->post('name'));
            $email = trim($request->post('email'));
            $phone = trim($request->post('phone'));
            $password = Hash::make($request->post('password'));
            
            DB::beginTransaction(); 
            DB::select("call CreateNew(?,?,?,?,?)",array($name,$email,$phone,$password,2));
            $insert_data = DB::select("CALL GetRowByEmail(?)",array($email));
            $insert_data = $insert_data[0];
            DB::commit();
            return array('resulte'=>true,'user'=>$insert_data);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }

    public function UpdatePersonalDetails($request,$data) {
        try {
            $id = $data['id'];
            $name = $data['name'];
            $photo = $data['photo'];
            $arr = array('photo'=>$photo,'name'=>$name);
            DB::beginTransaction(); 
            DB::table('users')->where("id",$id)->update($arr);
            DB::commit();
            $update_data = DB::select("CALL GetRowById(?)",array($id));
            $update_data = $update_data[0];
            return array('resulte'=>true,'data'=>$update_data);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }



    
    public function UpdateEmail($request,$data) {
        try {
            $id = $data['id'];
            $email = $data['email'];
            $arr = array('email'=>$email);
            DB::beginTransaction(); 
            DB::table('users')->where("id",$id)->update($arr);
            DB::commit();
            $update_data = DB::select("CALL GetRowById(?)",array($id));
            $update_data = $update_data[0];
            return array('resulte'=>true,'data'=>$update_data);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }

    public function UpdatePhone($request,$data) {
        try {
            $id = $data['id'];
            $phone = $data['phone'];
            $arr = array('phone'=>$phone);
            DB::beginTransaction(); 
            DB::table('users')->where("id",$id)->update($arr);
            DB::commit();
            $update_data = DB::select("CALL GetRowById(?)",array($id));
            $update_data = $update_data[0];
            return array('resulte'=>true,'data'=>$update_data);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }

    public function UpdatePassword($request,$data) {
        try {
            $id = $data['id'];
            $new_password = $data['new_password'];
            $arr = array('password'=>$new_password);
            DB::beginTransaction(); 
            DB::table('users')->where("id",$id)->update($arr);
            DB::commit();
            $update_data = DB::select("CALL GetRowById(?)",array($id));
            $update_data = $update_data[0];
            return array('resulte'=>true,'data'=>$update_data);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }


    











}
