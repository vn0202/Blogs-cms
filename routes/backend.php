<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

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

//login
Route::get('/admin/login',[LoginController::class, 'index'])->name('login');
Route::post('admin/login',[LoginController::class,'handle'])->name('handleLogin');
Route::get('admin/logout',[LoginController::class,"logout"])->name('logout');
//register
Route::get('/admin/register',[RegisterController::class,'index']);
Route::post('admin/register',[RegisterController::class,"handle"]);
Route::name('admin.')->prefix('/admin')
    ->middleware('auth')
    ->middleware('checkPermission')// to sure only admin and eidtor can assess
    ->group(function(){


        Route::get('/',[AdminController::class,'index'])->name('home');
        Route::get('/chinh-sua-thong-tin-ca-nhan',[AdminController::class,'update'])->name('edit');
        Route::post('/chinh-sua-thong-tin-ca-nhan',[AdminController::class,'save']);

        //list user
        Route::prefix('/users')->name('users.')
            ->middleware('adminPermission')
            ->group(function(){
                Route::get('/danh-sach-nguoi-dung',[UserController::class,'index'])->name('list-users');
                Route::get('/cap-quyen-user/{id}',[UserController::class,'update'])->where(['id'=>'\d+'])->name('edit-user');
                Route::post('/cap-quyen-user/{id}',[UserController::class,'save'])->name('handle-edit-user');
                Route::get('/destroy/{id}',[UserController::class,'delete'])->name('delete-user');
                Route::get('/them-nguoi-dung',[UserController::class,'create'])->name('create');
                Route::post('/them-nguoi-dung',[UserController::class,'store'])->name('store');
                Route::get('/sap-xep-danh-sach-nguoi-dung',[\App\Services\Admin\UserService::class,'sort'])->name('sort');
            });

        //Category and post
        Route::prefix('/category')->name('categories.')
            ->group(function(){
                Route::get('/',[CategoryController::class,'index'])->name('list-cat');
                Route::get('/add-category',[CategoryController::class,'create'])->name('add-cat');
                Route::post('/add-category',[CategoryController::class,'store'])->name('store-cat');
                Route::get('/edit-category/{id}',[CategoryController::class,'update'])->name('edit-cat');
                Route::post('/edit-category/{id}',[CategoryController::class,'save'])->name('handle-edit');
                Route::get('/destroy-category/{id}',[CategoryController::class,'delete'])->name('destroy-cat');
            });
        Route::prefix('/posts')->name('posts.')
            ->group(function(){
                Route::get('/',[PostController::class,'index'])->name('index');
                Route::get('/create-post',[PostController::class,'create'])->name('add-post');
                Route::post('/create-post',[PostController::class,'store'])->name('store-post');
                Route::get('/show-post/{id}',[PostController::class,'show'])->name('show-post');
                Route::get('/edit-post/{id}',[PostController::class,'update'])->name('edit-post');
                Route::post('/edit-post/{id}',[PostController::class,'save'])->name('handle-edit');
                Route::get('/destroy-post/{id}',[PostController::class,'delete'])->name('delete-post');
                Route::get('/filter-post',[\App\Services\Admin\PostService::class,'getDataFilter'])->name('filter-post');
                Route::get('/get-more-post',[PostController::class,'getMorePosts'])->name('get-more-post');
            });
        Route::prefix('/tags')->name('tags.')
            ->group(function (){
                Route::get('/',[TagController::class,'index'])->name('index');
                Route::get('/create-tag',[TagController::class,'create'])->name('create');
                Route::post('/create-tag',[\App\Http\Controllers\Admin\TagController::class,'store'])->name('create-tag');
                Route::post('/create-tag-ajax',[\App\Services\Admin\TagService::class,'storeTagByAjax'])->name('create-tag-ajax');

                Route::get('/edit-tag/{id}',[TagController::class,'update'])->name('edit-tag');
                Route::post('/edit-tag/{id}',[TagController::class,'save'])->name('handle-edit');
                Route::get('/delete-tag/{id}',[TagController::class,'delete'])->name('delete-tag');
                Route::post('/get-list-tag',[\App\Services\Admin\TagService::class,'get_list_tag'])->name('get-list-tag');
                Route::get('/get-list-tag/{post_id}',[\App\Services\Admin\TagService::class,'get_available_tags'])->name('get-tags');
            });



    });





