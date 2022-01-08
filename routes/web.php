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
Route::get('/blog/{slug}', [BlogPostController::class, 'singleBlog'])->name('blog');
Route::get('/blogs', [BlogPostController::class, 'allBlogs']);

//comments
Route::post('/blog/{slug}/comment', [CommentController::class, 'store'])->name('blog.comment');

//contact us
Route::post('/contact',[ContactController::class ,'store'])->name('contact');

//Route group for authenticated users only
Route::group(['middleware' => ['auth']], function()
{
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [SettingsController::class, 'index'])->name('profile');
    Route::get('/cms', [DashboardController::class, 'cmsView'])->name('cms');

    Route::get('/logout',[LoginController::class ,'logout'])->name('logout');
    Route::put('/settings/profile',[SettingsController::class ,'updateProfile'])->name('settings.profile');
    Route::put('/settings/password',[SettingsController::class ,'updatePassword'])->name('settings.password');

    //blog post
    Route::get('/admin/blog',[BlogPostController::class ,'createView'])->name('admin.blog'); 
    Route::get('/admin/blog/{slug}', [BlogPostController::class, 'adminSingleBlogPost'])->name('admin.single_blog');
    Route::get('/admin/blogs', [BlogPostController::class, 'adminAllBlogPosts'])->name('admin.blogs');
    Route::post('/admin/blog/create',[BlogPostController::class ,'store'])->name('admin.blog.create');
    Route::put('/admin/blog/update/{slug}',[BlogPostController::class ,'update'])->name('admin.blog.update');
    Route::get('/admin/blog/delete/{slug}', [BlogPostController::class, 'destroy'])->name('admin.blog.delete');

    //comments
    Route::get('/admin/comment/delete/{id}', [CommentController::class, 'destroy'])->name('admin.comment.delete');

    //CMS
    //banner
    Route::put('/admin/banner/update/{id}', [BannerController::class, 'update'])->name('admin.banner.update');
    Route::put('/admin/banner/update_image/{id}', [BannerController::class, 'updateImage'])->name('admin.banner.update_image');
    //about
    Route::put('/admin/about/about/{id}', [AboutController::class, 'update'])->name('admin.about.update');
    Route::put('/admin/about/about_image/{id}', [AboutController::class, 'updateImage'])->name('admin.about.update_image');
    

    //portfolio category
    Route::post('/admin/portfolio_category/create',[PortfolioCategoryController::class ,'store'])->name('admin.portfolio_category.create');
    Route::put('/admin/portfolio_category/update/{id}', [PortfolioCategoryController::class, 'update'])->name('admin.portfolio_category.update');
    Route::delete('/admin/portfolio_category/delete/{id}', [PortfolioCategoryController::class, 'destroy'])->name('admin.portfolio_category.delete');

    //portfolio 
    Route::post('/admin/portfolio/create',[PortfolioController::class ,'store'])->name('admin.portfolio.create');
    Route::put('/admin/portfolio/update/{id}', [PortfolioController::class, 'update'])->name('admin.portfolio.update');
    Route::put('/admin/portfolio/update_image/{id}', [PortfolioController::class, 'updateImage'])->name('admin.portfolio.update_image');
    Route::delete('/admin/portfolio/delete/{id}', [PortfolioController::class, 'destroy'])->name('admin.portfolio.delete');

    //Social media 
    Route::put('/admin/social_media/update/{id}', [SocialMediaController::class, 'update'])->name('admin.social_media.update');
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

    
    

