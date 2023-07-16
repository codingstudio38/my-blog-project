<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator; 
use Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\BlogModel;
use Auth;
use \App\ImgCompressor\ImgCompressor; 
class HomeController extends Controller
{
    public $UserModel;
    public $BlogModel;
    
    public function __construct(){
        $this->UserModel = new User; 
        $this->BlogModel = new BlogModel;
    }
    public function index(Request $request) {
        try {
            // $blog_data = DB::select("CALL QuarterStartAndEnd(?)",array(date('Y-m-d')));
            // $blog_data = $blog_data[0];
            // return gettype(date('Y-m-d',strtotime($blog_data->StartDate)));
            $home_data = $this->BlogModel->HomeData($request); 
            $data = array(
                'banner_list'=>$home_data['banner_list'],
                'all_blog_list'=>$home_data['all_blog_list'],
                'left_blog_list'=>$home_data['left_blog_list'],
                'total_single_blog'=>$home_data['total_single_blog'],
                'single_blog'=>$home_data['single_blog'],
            ); 
            return view('index',$data);
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }


    public function ShowAllBlog(Request $request) {
        try {
            $blog_data = $this->BlogModel->ShowAllBlog($request); 
            $data = array(
                'banner_list'=>$blog_data['banner_list'],
                'all_blog_list'=>$blog_data['all_blog_list'],
            );
            return view('all-blog',$data);
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }


    public function GetBlogByTitle(Request $request,$url_title) {
        try { 
            $indexpage = route('indexpage');
            $left_blog_list = $this->BlogModel::join('users','blog_list_tbl.user_id','=','users.id')
            ->select('users.name','blog_list_tbl.title','blog_list_tbl.status','blog_list_tbl.created_at')
            ->where('blog_list_tbl.status',1)
            ->orderBy('blog_list_tbl.id','desc')
            ->limit(6)
            ->get();
            if($this->BlogModel::where('title',urldecode($url_title))->count() <= 0){
                return redirect($indexpage)->with('failed_','Record not found.');
            } 
            $blog = $this->BlogModel->GetBlogByTitle($request,urldecode($url_title));
            if(!$blog['resulte']){
                throw new \Exception('Something went wrong. Please try again after some time.');
            }
            $data = array(
                'left_blog_list'=>$left_blog_list,
                'blog'=>$blog['data'],
            );
            return view('blog',$data);
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }



    public function Images_function(Request $request){
        try{
            
            return view('image-check');
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
            );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }


   
    public function Images_functionPOST(Request $request){
        try{ 
            $file_Newname = "";
          
            $route = route('images_');
            $images_check = route('images-check');
            $file_Newname= "";
           
            if($request->hasFile('photo')) {
                $file = $request->file('photo');
                $tmp_name = $file->getPathName();
                $fileName = $file->getClientOriginalName();
                $file_extension = $file->extension();
                $file_size = $file->getSize();
                $file_Newname = "file-".rand(11111, 99999).".".$file_extension;
                if(!getimagesize($_FILES['photo']['tmp_name'])){
                    return redirect($route)->with('failed_','Invalid file selected. Try again.');
                }
                if($file->move('public/myfile/',$file_Newname)){
                    // Make sure your php.ini have this line enabled for PHP 8
                    // extension=php_gd.dll
                    // For PHP lower than 8
                    // extension=php_gd2.dll
                    //https://stackoverflow.com/questions/718491/resize-animated-gif-file-without-destroying-animation
                    //https://stackoverflow.com/questions/5064839/resize-png-image-in-php
                    //https://github.com/bachors/PHP-Image-Compressor-Class
                    $source = public_path("myfile/$file_Newname");
                    $destination = public_path('myfile/'.'reset-'.$file_Newname);
                    $png_destination = public_path('myfile/'.'png-reset-'.$file_Newname);
                   
                   

                    $info = getimagesize($source);  
                    if ($info['mime'] == 'image/jpeg') {
                        $quality =20;
                     
                        $img = file_get_contents($source);
                        $originalImage = imagecreatefromstring($img);
                        $width = imagesx($originalImage); 
                        $height = imagesy($originalImage);
                        $new_width = $width*2;
                        $new_height = $height*2;
                        $thumb = imagecreatetruecolor($new_width, $new_height);
                        imagecopyresized($thumb, $originalImage, 0, 0, 0, 0, $new_width, $new_height, $width, $height); 
                        imagejpeg($thumb,$destination, $quality);
                        imagedestroy($thumb);
                       
 
                        //--------for image resolution compressor start-------//
                        // $image = imagecreatefromjpeg($destination);
                        // if (file_exists($destination)) {
                        //     unlink($destination);
                        // }
                        // imagejpeg($image, $destination, $quality);
                        //--------for image resolution compressor end-------//

                    } elseif ($info['mime'] == 'image/gif') {
                        $quality =20;
                        //--------for image resolution compressor end-------//
                        // $image = imagecreatefromgif($source);
                        // imagejpeg($image, $destination, $quality);
                        //--------for image resolution compressor end-------//
                        $img = imagecreatefromgif($source);
                        imagetruecolortopalette($img, true, 20);  //  compress to 16 colors in gif palette (change 16 to anything between 1-256)
                        imagegif($img, $destination);
                    } elseif ($info['mime'] == 'image/png') {
                        $quality =9;
                        
                        $originalImage = imagecreatefrompng($source); 
                        list($x, $y) = getimagesize($source);
                        $new_width  = $x*2;
                        $new_height = $y*2;
                        $compressedImage  = imagecreatetruecolor($new_width,$new_height);
                        $preto = imagecolorallocate($compressedImage, 0, 0, 0);
                        imagealphablending($compressedImage , false);
                        imagesavealpha($compressedImage, true);
                        imagecolortransparent($compressedImage, $preto);
                        imagecopymerge($originalImage, $compressedImage, 0, 0, 0, 0, $x, $y, 100);
                        imagecopyresized($compressedImage,$originalImage,0,0,0,0,$new_width,$new_height, $x, $y );
                        imagealphablending($compressedImage , false);
                        imagesavealpha($compressedImage , true);
                        imagepng($compressedImage,$destination, $quality);
                        imagedestroy($compressedImage);
                        imagedestroy($originalImage);
                    } else {
                        return redirect($route)->with('failed_','Allow only jpg, png, gif file.');
                    }
                   
                    return redirect($route)->with('success_','File successfully moved.');
                } else {
                return redirect($route)->with('failed_','Failed to moved file. Try again.');
                }
            } else {
                return redirect($route)->with('failed_','file required.');
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


    public function ShowMap(Request $request) { 
        try {
            $blog_data = $this->BlogModel->ShowAllBlog($request); 
            $data = array(
                'banner_list'=>$blog_data['banner_list'],
                // 'all_blog_list'=>$blog_data['all_blog_list'],
            ); 
            return view('map',$data); 
        } catch (\Throwable $error) {
            $data = array(
                'message'=>$error->getMessage(),
                'errors'=>$error
             );
            return view('error_handler.ERROR_PAGE',$data);
        }
    }





}
