<?php

namespace App\Jobs;

use File;
use Image;
use App\Models\BlogPost;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UploadImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $blog_post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(BlogPost $blog_post)
    {
        $this->blog_post = $blog_post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $disk = $this->blog_post->disk;
        $filename = $this->blog_post->image;
        $original_file = storage_path('/uploads/original/' . $filename);

        //try{
            //create the large image and save to tmp disk
            Image::make($original_file)
            ->fit(800, 600, function($constraint)
            {
                $constraint->aspectRatio();
            })
            ->save($large = storage_path('uploads/large/'.$filename));
            //create thumbnail
            Image::make($original_file)
            ->fit(250, 200, function ($constraint)
            {
                $constraint->aspectRatio();
            })
            ->save($thumbnail = storage_path('uploads/thumbnail/'.$filename));
            //store to a permanent disk
            //original image
            if(Storage::disk($disk)
                ->put('uploads/blog_posts/original/'.$filename, fopen($original_file, 'r+'))){
                    File::delete($original_file);
                }
            //thumbnail
            if(Storage::disk($disk)
                ->put('uploads/blog_posts/thumbnail/'.$filename, fopen($thumbnail, 'r+'))){
                File::delete($thumbnail);
            }
            //large
            if(Storage::disk($disk)
                ->put('uploads/blog_posts/large/'.$filename, fopen($large, 'r+'))){
                File::delete($large);
            }

            //update success flag
            $this->blog_post->update([
                'upload_successful' => true
            ]);
        
    }
}
