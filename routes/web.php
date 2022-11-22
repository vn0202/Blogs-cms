<?php
//
//use App\Http\Controllers\Auth\LoginController;
//use App\Http\Controllers\Auth\RegisterController;
//use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\AdminController;
//use App\Http\Controllers\Admin\UserController;
//use App\Http\Controllers\Admin\CategoryController;
//use App\Http\Controllers\Admin\PostController;
//use App\Http\Controllers\Admin\TagController;
//use App\Http\Controllers\Frontend\Auth\UserLoginController;
//use App\Http\Controllers\Frontend\MainController;
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
////login
//Route::get('/login',[UserLoginController::class, 'index'])->name('login');
//Route::post('/login',[UserLoginController::class,'handle'])->name('handleLogin');
//Route::get('/logout',[UserLoginController::class,"logout"])->name('logout');
////resgister
//Route::get('/register',[RegisterController::class,'index']);
//Route::post('/register',[RegisterController::class,"handle"]);
//
//
//Route::name('admin.')->prefix('/admin')
//    ->middleware('auth')
//    ->middleware('checkPermission')// to sure only admin and eidtor can assess
//    ->group(function(){
//    Route::get('/',[AdminController::class,'index'])->name('home');
//    Route::get('/chinh-sua-thong-tin-ca-nhan',[AdminController::class,'editor'])->name('edit');
//    Route::post('/chinh-sua-thong-tin-ca-nhan',[AdminController::class,'handleEdit']);
//
//    //list user
//    Route::prefix('/users')->name('users.')
//        ->middleware('adminPermission')
//        ->group(function(){
//        Route::get('/danh-sach-nguoi-dung',[UserController::class,'index'])->name('list-users');
//        Route::get('/cap-quyen-user/{id}',[UserController::class,'edit'])->where(['id'=>'\d+'])->name('edit-user');
//        Route::post('/cap-quyen-user/{id}',[UserController::class,'handleEdit'])->name('handle-edit-user');
//        Route::get('/destroy/{id}',[UserController::class,'delete_user'])->name('delete-user');
//        Route::get('/them-nguoi-dung',[UserController::class,'create'])->name('create');
//        Route::post('/them-nguoi-dung',[UserController::class,'store'])->name('store');
//        Route::post('/danh-sach-nguoi-dung',[UserController::class,'sort'])->name('sort');
//        });
//
//    //Category and post
//        Route::prefix('/category')->name('categories.')
//            ->group(function(){
//                Route::get('/',[CategoryController::class,'index'])->name('list-cat');
//                Route::get('/add-category',[CategoryController::class,'create'])->name('add-cat');
//                Route::post('/add-category',[CategoryController::class,'store'])->name('store-cat');
//                Route::get('/edit-category/{id}',[CategoryController::class,'edit'])->name('edit-cat');
//                Route::post('/edit-category/{id}',[CategoryController::class,'handleEdit'])->name('handle-edit');
//                Route::get('/destroy-category/{id}',[CategoryController::class,'destroy'])->name('destroy-cat');
//            });
//        Route::prefix('/posts')->name('posts.')
//            ->group(function(){
//                Route::get('/',[PostController::class,'index'])->name('index');
//                Route::get('/create-post',[PostController::class,'create'])->name('add-post');
//                Route::post('/create-post',[PostController::class,'store'])->name('store-post');
//                Route::get('/show-post/{id}',[PostController::class,'show'])->name('show-post');
//                Route::get('/edit-post/{id}',[PostController::class,'edit'])->name('edit-post');
//                Route::post('/edit-post/{id}',[PostController::class,'handleEdit'])->name('handle-edit');
//                Route::get('/destroy-post/{id}',[PostController::class,'delete'])->name('delete-post');
//                Route::get('/filter-post',[PostController::class,'filter'])->name('filter-post');
//            });
//        Route::prefix('/tags')->name('tags.')
//            ->group(function (){
//                Route::get('/',[TagController::class,'index'])->name('index');
//                Route::get('/create-tag',[TagController::class,'create'])->name('create');
//                Route::post('/create-tag',[\App\Http\Controllers\Admin\TagController::class,'handleCreate'])->name('create-tag');
//                Route::get('/edit-tag/{id}',[TagController::class,'edit'])->name('edit-tag');
//                Route::post('/edit-tag/{id}',[TagController::class,'handleEdit'])->name('handle-edit');
//                Route::get('/delete-tag/{id}',[TagController::class,'delete'])->name('delete-tag');
//            });
//
//
//
//});
//
//Route::prefix('/')
//    ->group(function (){
//      Route::get('/',[MainController::class,'index']);
//    });
//
//
//
