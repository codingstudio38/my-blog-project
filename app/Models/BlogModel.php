<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \Hash;
class BlogModel extends Model
{
    use HasFactory;
    protected $table = "blog_list_tbl";
    protected $fillable = [
        'title',
        'description',
        'photo',
    ]; 

 
    public function SaveNewBlog($request,$data) {
        try {
            $title = $data['title'];
            $description = $data['description'];
            $photo = $data['photo'];
            $user_id = $data['user_id'];
            DB::beginTransaction(); 
            DB::select("call CreateNewBlog(?,?,?,?)",array($photo,$title,$description,$user_id));
            $insert_data = DB::select("CALL GetBlogByTitle(?)",array($title));
            $insert_data = $insert_data[0];
            DB::commit();
            return array('resulte'=>true,'data'=>$insert_data);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }


    public function UpdateBlog($request,$data) {
        try {
            $id = $data['id'];
            $title = $data['title'];
            $description = $data['description'];
            $photo = $data['photo']; 
            $user_id = $data['user_id'];
            DB::beginTransaction(); 
            DB::select("call UpdateBlog(?,?,?,?,?)",array($id,$photo,$title,$description,$user_id));
            $update_data = DB::select("CALL GetBlogByTitle(?)",array($title));
            $update_data = $update_data[0];
            DB::commit();
            return array('resulte'=>true,'data'=>$update_data);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }

    public function DeleteBlog($request,$data) {
        try {
            $id = $data['id'];
            $oldphoto = $data['oldphoto'];
            DB::beginTransaction();  
            DB::select("CALL DeleteBlogById(?)",array($id));
            $Path = public_path("blog/$oldphoto");
            if (\File::exists($Path)){
                \File::delete($Path);
            }
            DB::commit();
            return array('resulte'=>true,'data'=>'');
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }

    public function UpdateBlogStatus($request,$data) {
        try {
            $id = $data['id'];
            $status = $data['status'];
            $arr = array('status'=>$status);
            DB::beginTransaction(); 
            DB::table('blog_list_tbl')->where("id",$id)->update($arr);
            DB::commit();
            return array('resulte'=>true,'data'=>'');
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }    
    
 
    public function GetBlogByTitle($request,$url_title) {
        try {
            $blog_data = DB::select("CALL GetBlogByTitle(?)",array($url_title));
            $blog_data = $blog_data[0];
            return array('resulte'=>true,'data'=>$blog_data);
        } catch (\Throwable $error) {
            throw $error;
        }
    } 
    
    public function GetBlogById($id) {
        try {
            $blog_data = DB::select("CALL GetBlogById(?)",array($id));
            $blog_data = $blog_data[0];
            return array('resulte'=>true,'data'=>$blog_data);
        } catch (\Throwable $error) {
            throw $error;
        }
    } 


    public function HomeData($request) {
        try {
           $single_blog_query = $this->join('users','blog_list_tbl.user_id','=','users.id')
            ->select('users.name','users.photo as user_photo','blog_list_tbl.title','blog_list_tbl.photo','blog_list_tbl.status','blog_list_tbl.description','blog_list_tbl.created_at')
            ->where('blog_list_tbl.status',1)
            ->orderBy('blog_list_tbl.id','desc');
            $total_single_blog = $single_blog_query->count();
            $single_blog = $single_blog_query->first();
            $banner_list = $this->select('title','status','photo','description')
            ->where('status',1)
            ->orderBy('id','desc')
            ->limit(4)
            ->get();
            $all_blog_list = $this->join('users','blog_list_tbl.user_id','=','users.id')
            ->select('users.name','blog_list_tbl.title','blog_list_tbl.photo','blog_list_tbl.status','blog_list_tbl.description','blog_list_tbl.created_at')
            ->where('blog_list_tbl.status',1)
            ->orderBy('blog_list_tbl.id','desc')
            ->limit(6)
            ->get();
            $left_blog_list = $this->join('users','blog_list_tbl.user_id','=','users.id')
            ->select('users.name','blog_list_tbl.title','blog_list_tbl.status','blog_list_tbl.created_at')
            ->where('blog_list_tbl.status',1)
            ->orderBy('blog_list_tbl.id','desc')
            ->limit(6)
            ->get();
            return array(
                'banner_list'=>$banner_list,
                'all_blog_list'=>$all_blog_list,
                'left_blog_list'=>$left_blog_list,
                'total_single_blog'=>$total_single_blog,
                'single_blog'=>$single_blog,
            );
        } catch (\Throwable $error) {
            throw $error;
        }
    } 


    public function ShowAllBlog($request) {
        try {
            $banner_list = $this->select('title','status','photo','description')
            ->where('status',1)
            ->orderBy('id','desc')
            ->limit(4) 
            ->get();
            $all_blog_list = $this->join('users','blog_list_tbl.user_id','=','users.id')
            ->select('users.name','blog_list_tbl.title','blog_list_tbl.photo','blog_list_tbl.status','blog_list_tbl.description','blog_list_tbl.created_at')
            ->where('blog_list_tbl.status',1)
            ->orderBy('blog_list_tbl.id','desc')
            ->paginate(9);
            return array(
                'banner_list'=>$banner_list,
                'all_blog_list'=>$all_blog_list,
            );
        } catch (\Throwable $error) {
            throw $error;
        }
    }
    




}
