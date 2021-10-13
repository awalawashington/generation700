<?php

namespace App\Http\Controllers\BlogPosts;

use App\Jobs\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogPostController extends Controller
{
    public function adminAllBlogPosts(Type $var = null)
    {
        return view('Admin.Admin.Blog.all');
    }

    public function createView()
    {
        return view('Admin.Admin.Blog.create');
    }

    public function adminSingleBlogPost($slug)
    {
        return view('Admin.Admin.Blog.single');
    }

    //create blog post

    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'image' => 'required|mimes:jpeg,gif,bmp,png|max:2048'
        ]);

        $image = $request->file('image');
        $image_path = $image->getPathName();

        //get the original file name and replace any spaces with _
        $filename = time()."_".  preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
        
        //move image to the temporary storage
        $tmp = $image->storeAs('uploads/original', $filename, 'tmp');

        //create the database record for the post
        $blog_post = auth()->user()->blog_posts()->create([
            'image' => $filename,
            'disk' => config('site.upload_disk')
        ]);

        //dispatch a job to handle the image manipulation
        $this->dispatch(new UploadImage($blog_post));

        return ("success");
        
    }

    
}
