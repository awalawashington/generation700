<?php

namespace App\Http\Controllers\Users;

use App\Models\About;
use App\Models\Banner;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\BlogPost;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use App\Models\PortfolioCategory;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Admin.Admin.dashboard',[
            'about' => About::latest()->first(),
            'banner' => Banner::latest()->first(),
            'portfolio_categories' => PortfolioCategory::all(),
            'social_media' => SocialMedia::latest()->first(),
            'blogs' => BlogPost::orderBy('id', 'DESC')->get(),
            'comments' => Comment::orderBy('id', 'DESC')->get(),
            'contacts' => Contact::orderBy('id', 'DESC')->get()
        ]);
    }

    public function cmsView()
    {
     
        return view('Admin.Admin.cms',[
            'about' => About::latest()->first(),
            'banner' => Banner::latest()->first(),
            'portfolio_categories' => PortfolioCategory::orderBy('id', 'DESC')->get(),
            'social_media' => SocialMedia::latest()->first()
        ]);
    }
    
}
