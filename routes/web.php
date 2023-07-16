<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BlogController;
/* 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/   
//git status
//git add .
//git commit -m "second commit"
 //>composer create-project laravel/laravel="^8" myProject
Route::fallback(function(){ 
    try { 
        return view('error_handler.500_ERROR');
    } catch (\Throwable $error) {
        // throw new Exception("500 !");
         $data = array(
            'message'=>$error->getMessage(),
            'errors'=>$error
         );
        return view('error_handler.ERROR_PAGE',$data);
    }
});  
     
Route::get("/",[HomeController::class, 'index'])->name('indexpage');
Route::get('/images_', [HomeController::class, 'Images_function'])->name('images_');
Route::post('/images-check', [HomeController::class, 'Images_functionPOST'])->name('images-check');
Route::get('/blog/{title}', [HomeController::class, 'GetBlogByTitle'])->name('show-blog');
Route::get('/all-blog', [HomeController::class, 'ShowAllBlog'])->name('all-blog');
Route::get('/map', [HomeController::class, 'ShowMap'])->name('map');

Route::get("/login",[UsersController::class, 'login'])->name('login')->middleware('UserIsNotloggedin');
Route::post("/user-login",[UsersController::class, 'UserLogin'])->name('user-login')->middleware('UserIsNotloggedin');
Route::get("/register",[UsersController::class, 'Register'])->name('register')->middleware('UserIsNotloggedin');
Route::post("/user-register",[UsersController::class, 'UserRegister'])->name('user-register')->middleware('UserIsNotloggedin'); 
      
Route::group(['prefix'=>'user','middleware'=>'UserIsloggedin'],function() {
    Route::get('/', [UsersController::class, 'UserHome'])->name('user-home');

    Route::get('/user-profile', [UsersController::class, 'ShowUserProfile'])->name('user-profile');
    Route::post('/update-personal-details', [UsersController::class, 'UpdatePersonalDetails'])->name('update-personal-details');
    Route::post('/update-email', [UsersController::class, 'UpdateEmail'])->name('update-email');
    Route::post('/update-phone', [UsersController::class, 'UpdatePhone'])->name('update-phone');
    Route::post('/update-password', [UsersController::class, 'UpdatePassword'])->name('update-password');
 
    Route::get('/view-blog', [BlogController::class, 'ViewBlog'])->name('view-blog');
    Route::get('/add-new-blog', [BlogController::class, 'AddNewBlog'])->name('add-new-blog');
    Route::post('/save-new-blog', [BlogController::class, 'SaveNewBlog'])->name('save-new-blog');
    Route::get('/edit-blog/{id}', [BlogController::class, 'EditBlog'])->name('edit-blog');
    Route::post('/update-blog/{id}', [BlogController::class, 'UpdateBlog'])->name('update-blog');
    Route::get('/blog-status/{id}/{status}', [BlogController::class, 'UpdateBlogStatus'])->name('blog-status');
    Route::get('/delete-blog/{id}', [BlogController::class, 'DeleteBlog'])->name('delete-blog');

    Route::get('/user-logout', [UsersController::class, 'UserLogout'])->name('user-logout');
});