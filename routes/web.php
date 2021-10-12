<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CMS\AboutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CMS\BannerController;
use App\Http\Controllers\CMS\PortfolioController;
use App\Http\Controllers\Users\SettingsController;
use App\Http\Controllers\CMS\SocialMediaController;
use App\Http\Controllers\Users\DashboardController;
use App\Http\Controllers\BlogPosts\CommentController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BlogPosts\BlogPostController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CMS\PortfolioCategoryController;

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

//Route group for public users
Route::get('/', [WelcomeController::class, 'index']);

//blog
Route::get('/blog/{slug}', [BlogPostController::class, 'findBlogPost']);
Route::get('/blogs', [BlogPostController::class, 'index']);

//comments
Route::post('/blog/{slug}/comment', [CommentController::class, 'store']);

//contact us
Route::post('/contact',[ContactController::class ,'store']);

//Route group for authenticated users only
Route::group(['middleware' => ['auth']], function()
{
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [SettingsController::class, 'index']);
    Route::get('/cms', [DashboardController::class, 'cmsView']);

    Route::get('/logout',[LoginController::class ,'logout']);
    Route::put('/settings/profile',[SettingsController::class ,'updateProfile']);
    Route::put('/settings/password',[SettingsController::class ,'updatePassword']);

    //blog post
    Route::get('/admin/blog/{slug}', [BlogPostController::class, 'adminSingleBlogPost']);
    Route::get('/admin/blogs', [BlogPostController::class, 'adminAllBlogPosts']);
    Route::get('admin/blog',[BlogPostController::class ,'createView']);
    Route::post('admin/blog',[BlogPostController::class ,'store']);
    Route::put('/blog/{slug}', [BlogPostController::class, 'update']);
    Route::delete('/blog/{slug}', [BlogPostController::class, 'destroy']);

    //comments
    Route::delete('/comment/{id}', [CommentController::class, 'destroy']);

    //CMS
    //banner
    Route::put('/banner/{id}', [BannerController::class, 'update']);
    //about
    Route::put('/banner/{id}', [AboutController::class, 'update']);

    //portfolio category
    Route::post('/portfolio_category',[PortfolioCategoryController::class ,'store']);
    Route::put('/portfolio_category/{id}', [PortfolioCategoryController::class, 'update']);
    Route::delete('/portfolio_category/{id}', [PortfolioCategoryController::class, 'destroy']);

    //portfolio 
    Route::post('/portfolio',[PortfolioController::class ,'store']);
    Route::put('/portfolio/{id}', [PortfolioController::class, 'update']);
    Route::delete('/portfolio/{id}', [PortfolioController::class, 'destroy']);

    //Social media 
    Route::post('/social_media',[SocialMediaController::class ,'store']);
    Route::put('/social_media/{id}', [SocialMediaController::class, 'update']);
    Route::delete('/social_media/{id}', [SocialMediaController::class, 'destroy']);
});

//Route group for authenticated GUEST only
Route::group(['middleware' => ['guest']], function()
{
    Route::get('/login',[LoginController::class ,'loginView'])->name('login');
    Route::post('/login',[LoginController::class ,'login']);
    Route::get('/password/forgot',[ForgotPasswordController::class ,'forgotPasswordView']);
    Route::post('/password/email',[ForgotPasswordController::class ,'sendResetLinkEmail']);
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'resetPasswordView'])->name('password.reset');
    Route::post('/password/reset',[ResetPasswordController::class ,'reset']);
});

    
    

