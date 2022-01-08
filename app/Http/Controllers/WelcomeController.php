<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\BlogPost;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use App\Models\PortfolioCategory;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome',[
            'about' => About::latest()->first(),
            'banner' => Banner::latest()->first(),
            'portfolio_categories' => PortfolioCategory::all(),
            'social_media' => SocialMedia::latest()->first(),
            'blogs' => BlogPost::orderBy('id', 'DESC')->limit(3)->get(),
            
        ]);
    }
}
