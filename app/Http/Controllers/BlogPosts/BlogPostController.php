<?php

namespace App\Http\Controllers\BlogPosts;

use App\Models\BlogPost;
use App\Jobs\UploadImage;
use App\Models\SocialMedia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogPostController extends Controller
{
    public function allBlogs()
    {
        return view('blogs',[
            'blogs' => BlogPost::all(),
            'social_media' => SocialMedia::latest()->first(),
        ]);
    }

    public function singleBlog($slug)
    {
        return view('blog', [
            'blog' => BlogPost::where('slug', $slug)->firstOrFail()
        ]);
    }


    public function adminAllBlogPosts()
    {
        return view('Admin.Admin.Blog.all',[
            'blogs' => BlogPost::orderBy('id', 'desc')->get()
        ]);
    }

    public function createView()
    {
        return view('Admin.Admin.Blog.create', [
            'blogs' => BlogPost::orderBy('id', 'desc')->get()
        ]);
    }

    public function adminSingleBlogPost($slug)
    {
        return view('Admin.Admin.Blog.single',[
            'blogs' => BlogPost::all(),
            'blog' => BlogPost::where('slug', '=', $slug)->firstOrFail()
        ]); 
    }

    //create blog post

    public function store(Request $request)
    {
        //validate request 
        $request->validate([
            'image' => 'required|mimes:jpeg,gif,bmp,png|max:2048',
            'title' => ['required', 'unique:blog_posts,title', 'max:60'],
            'description' => ['string', 'required', ]
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
            'disk' => config('site.upload_disk'),
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'is_live' => true
        ]);

        //dispatch a job to handle the image manipulation
        $this->dispatch(new UploadImage($blog_post));

        return redirect()->route('admin.single_blog', $blog_post->slug)->with('success','Blog successfully published');
        
    }

    public function update(Request $request, $slug)
    {
        $blog = BlogPost::where('slug', '=', $slug)->firstOrFail();
        //validate request
        $request->validate([
            'title' => ['required', 'unique:blog_posts,title,'.$blog->id, 'max:60'],
            'description' => ['string', 'required', 'min:20'],
            'image' => 'sometimes|required|mimes:jpeg,gif,bmp,png|max:2048',
        ]);

        if ($request->has('image')) {
            $image = $request->file('image');
            $image_path = $image->getPathName();

            //get the original file name and replace any spaces with _
            $filename = time()."_".  preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
            
            //move image to the temporary storage
            $tmp = $image->storeAs('uploads/original', $filename, 'tmp');

            $blog->update([
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::slug($request->title),
                'image' => $filename,
            ]);
            
            //dispatch a job to handle the image manipulation
            $this->dispatch(new UploadImage($blog));
        }else{
            $blog = $blog->update([
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::slug($request->title),
            ]);
        }      

        return redirect()->route('admin.single_blog', $slug)->with('success','Blog successfully Edited');
        
    }

    public function destroy($slug)
    {
        $blog = BlogPost::where('slug', '=', $slug)->firstOrFail();
        $blog->delete();
        return redirect()->route('admin.blog')->with('success','Blog successfully Deleted');

    }
    
}
