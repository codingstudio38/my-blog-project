<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator; 
use Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\BlogModel;
use Auth;
class BlogController extends Controller
{
    public $UserModel;
    public $BlogModel;
    
    
    public function __construct(){
        $this->UserModel = new User;
        $this->BlogModel = new BlogModel;
    } 

    public function ViewBlog(Request $request) {
        try {
            $loggedin_user = session()->get('user_data');
            $blog_list = $this->BlogModel::where('user_id',$loggedin_user->id)->orderBy('id','desc')->paginate(9);
            $data = array(
                'blog_list'=>$blog_list,
            );
            return view('user.view-blog',$data);
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }
 
    public function AddNewBlog(Request $request) {
        try {
             
            return view('user.add-blog');
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }

    public function SaveNewBlog(Request $request) {
        try {
            //'required|file|mimes:jpg,jpeg,png|max:50000',
            //'dimensions:min_width=500,max_width=1500'
        $validate = Validator::make($request->all(),[
            'title' => 'required|unique:blog_list_tbl|max:250',
            'description' => 'required',
            'photo' => ['required','image','mimes:jpeg,png,jpg', 'max:500'],
            ],[ 
            "title.required" => "Blog title required.",
            "title.unique" => "Blog title already exists. Try different.",
            "title.max" => "Blog title should 250 characters.",
            "description.required" => "Description required.",
            "photo.required" => "Blog image required.",
            "photo.image" => "Allow only image.",
            "photo.max" => "Image size should be size less than 500 kb",
            "photo.mimes" => "Please select jpg, png file..!!",
        ]);
        $addnewblog_route = route('add-new-blog');
      
        if($validate->fails()){ 
            return redirect($addnewblog_route)->withErrors($validate->errors())->withInput();
        }  
        $loggedin_user = session()->get('user_data');
        $title =  trim(str_replace("/"," ",$request->post('title')));
        $description = $request->post('description');//mysql_escape($request->post('description'));
        $file_Newname= "";
        if($request->hasFile('photo')) {
            if(!getimagesize($_FILES['photo']['tmp_name'])){
                return redirect($addnewblog_route)->with('failed_','Invalid file selected. Try again.');
            }  
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "blog-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/blog/',$file_Newname)){
                $data_collection = array(
                    'title'=>$title,  
                    'description'=>$description,
                    'photo'=>$file_Newname, 
                    'user_id'=>$loggedin_user->id,
                );
                $data = $this->BlogModel->SaveNewBlog($request,$data_collection);
                if(!$data['resulte']){
                    throw new \Exception('Failed to save blog. Please try again after some time.');
                }
                return redirect($addnewblog_route)->with('success_','Successfully Saved.');
            } else {
              return redirect($addnewblog_route)->with('failed_','Failed to upload blog photo. Try after some time.');
            }
        } else {
          return redirect($addnewblog_route)->with('failed_','Blog image required.')->withInput();
        }
       
        } catch (\Throwable $error) {
            $Path = public_path("blog/$file_Newname");
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



    public function EditBlog(Request $request,$url_id) {
        try {
            $viewblog_route = route('view-blog');
            $addnewblog_route = route('add-new-blog');
            $row_id = base64_decode($url_id);
            if($this->BlogModel::where('id',$row_id)->count() <= 0){
                return redirect($viewblog_route)->with('failed_','Record not found.');
            } 
            $blog = $this->BlogModel->GetBlogById($row_id);
            $data_collection = array(
                'blog'=>$blog['data'],
            );
            return view('user.edit-blog',$data_collection);
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }

    public function UpdateBlog(Request $request,$url_id) {
        try {
            $viewblog_route = route('view-blog');
            $addnewblog_route = route('add-new-blog');
            $editblog_route = route('edit-blog',['id'=>$url_id]);
            $row_id = base64_decode($url_id);
            if($this->BlogModel::where('id',$row_id)->count() <= 0){
                return redirect($viewblog_route)->with('failed_','Record not found.');
            }
            if($request->hasFile('photo')) {
                $validate = Validator::make($request->all(),[
                    'title' => 'required|unique:blog_list_tbl,title,'.$row_id.',id|max:250',
                    'description' => 'required',
                    'photo' => ['required','image','mimes:jpeg,png,jpg', 'max:500'],
                    ],[ 
                    "title.required" => "Blog title required.",
                    "title.unique" => "Blog title already exists. Try different.",
                    "title.max" => "Blog title should 250 characters.",
                    "description.required" => "Description required.",
                    "photo.required" => "Blog image required.",
                    "photo.image" => "Allow only image.",
                    "photo.max" => "Image size should be size less than 500 kb",
                    "photo.mimes" => "Please select jpg, png file..!!",
                ]);
            } else {  
                $validate = Validator::make($request->all(),[
                    'title' => 'required|unique:blog_list_tbl,title,'.$row_id.',id|max:250',
                    'description' => 'required',
                    ],[ 
                    "title.required" => "Blog title required.",
                    "title.unique" => "Blog title already exists. Try different.",
                    "title.max" => "Blog title should 250 characters.",
                    "description.required" => "Description required.",
                ]);
            } 
            if($validate->fails()){ 
                return redirect($editblog_route)->withErrors($validate->errors())->withInput();
            } 
            $title = trim(str_replace("/"," ",($request->post('title'))));
            $description = $request->post('description');
            $blog = $this->BlogModel::where('id',$row_id)->first();
            $loggedin_user = session()->get('user_data');
            $file_Newname = "";
            if($request->hasFile('photo')) {
                if(!getimagesize($_FILES['photo']['tmp_name'])){
                    return redirect($editblog_route)->with('failed_','Invalid file selected. Try again.');
                }
                $file = $request->file('photo');
                $fileName = $file->getClientOriginalName();
                $file_extension = $file->extension();
                $file_size = $file->getSize();
                $file_Newname = "blog-".rand(11111, 99999).".".$file_extension;
                if($file->move('public/blog/',$file_Newname)){
                    $data_collection = array(
                        'id'=>$row_id,
                        'title'=>$title,
                        'description'=>$description,
                        'photo'=>$file_Newname,
                        'user_id'=>$loggedin_user->id,
                    );
                    $data = $this->BlogModel->UpdateBlog($request,$data_collection);
                    if(!$data['resulte']){
                        throw new \Exception('Failed to update blog. Please try again after some time.');
                    }
                    $oldPath = public_path("blog/".$blog->photo);
                    if (\File::exists($oldPath)){
                        \File::delete($oldPath);
                    }
                    return redirect($viewblog_route)->with('success_','Successfully updated.');
                } else {
                  return redirect($editblog_route)->with('failed_','Failed to upload blog photo. Try after some time.');
                }
            } else {
                $data_collection = array(
                    'id'=>$row_id,
                    'title'=>$title,
                    'description'=>$description,
                    'photo'=>$blog->photo,
                    'user_id'=>$loggedin_user->id,
                ); 
                $data = $this->BlogModel->UpdateBlog($request,$data_collection);
                if(!$data['resulte']){
                    throw new \Exception('Failed to update blog. Please try again after some time.');
                }
                return redirect($viewblog_route)->with('success_','Successfully updated.');
            }
        } catch (\Throwable $error) {
            $Path = public_path("blog/$file_Newname");
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


 
    public function DeleteBlog(Request $request,$url_id) {
        try {
            $viewblog_route = route('view-blog');
            $addnewblog_route = route('add-new-blog');
            $row_id = base64_decode($url_id);
            if($this->BlogModel::where('id',$row_id)->count() <= 0){
                return redirect($viewblog_route)->with('failed_','Record not found.');
            }
            $blog = $this->BlogModel::where('id',$row_id)->first();
            $data_collection = array(
                'id'=>$blog->id,
                'oldphoto'=>$blog->photo,
            ); 
            $data = $this->BlogModel->DeleteBlog($request,$data_collection);
            if(!$data['resulte']){
                throw new \Exception('Failed to delete. Please try again after some time.');
            }
            return redirect($viewblog_route)->with('success_','Successfully deleted.');
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }


    public function UpdateBlogStatus(Request $request,$url_id,$status) {
        try {
            $viewblog_route = route('view-blog');
            $addnewblog_route = route('add-new-blog');
            $row_id = base64_decode($url_id);
            if(!in_array($status, array(0,1))){
                return redirect($viewblog_route)->with('failed_','Invalid status.');
            }
            if($this->BlogModel::where('id',$row_id)->count() <= 0){
                return redirect($viewblog_route)->with('failed_','Record not found.');
            }
            $blog = $this->BlogModel::where('id',$row_id)->first();
            $data_collection = array(
                'id'=>$blog->id,
                'status'=>$status,
            ); 
            $data = $this->BlogModel->UpdateBlogStatus($request,$data_collection);
            if(!$data['resulte']){
                throw new \Exception('Failed to update status. Please try again after some time.');
            }
            return redirect($viewblog_route)->with('success_','Successfully updated.');
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }





}
