<?php

namespace App\Jobs;

use File;
use Image;
use App\Models\Banner;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UploadBannerImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $banner;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $disk = 'public';
        $filename = $this->banner->image;
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
                ->put('uploads/banners/original/'.$filename, fopen($original_file, 'r+'))){
                    File::delete($original_file);
                }
            //thumbnail
            if(Storage::disk($disk)
                ->put('uploads/banners/thumbnail/'.$filename, fopen($thumbnail, 'r+'))){
                File::delete($thumbnail);
            }
            //large
            if(Storage::disk($disk)
                ->put('uploads/banners/large/'.$filename, fopen($large, 'r+'))){
                File::delete($large);
            }
        
    }
}
