
<?php
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\Auth\UserLoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\Auth\LoginByGoogleController;
use Laravel\Socialite\Facades\Socialite;

Route::name('frontend.')->prefix('/')
        ->group(function(){
            Route::get('/',[MainController::class,'index'])->name('home');
            Route::get('/get-more-posts',[MainController::class,'getMorePosts'])->name('get-more-posts');
            Route::get('/handle-click-see-more',[PostController::class,'handleClickSeeMore'])->name('handle-click-see');

            Route::get('/login',[UserLoginController::class,'login'])->name('login');
            Route::post('/login',[UserLoginController::class,'handleLogin'])->name('handle-login');

            Route::get('/register',[RegisterController::class,'index'])->name('register');
            Route::post('/register',[RegisterController::class,'handle'])->name('handle-register');
            Route::get('/edit',[UserController::class,'index'])->name('edit');
            Route::post('/edit',[UserController::class,'handle'])->name('handle');
            Route::get('/logout',[UserLoginController::class,'logout'])->name('logout');

            Route::get('/category/{category}',[MainController::class,'list_post_by_category'])->name('list-post-by-category');
            Route::post('/search',[MainController::class,'search'])->name('search');
            Route::get('/{category}/{slug}.htm',[MainController::class,'detail'])->name('detail-post');
            Route::get('/tag/{slug}',[MainController::class,'list_post_by_tag'])->name('list-post-tag');

            Route::get('auth/google',[LoginByGoogleController::class,'redirect'])->name('google-auth');
            Route::get('auth/google/callback',[LoginByGoogleController::class,'callbackGoogle']);



        });
