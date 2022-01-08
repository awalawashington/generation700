<?php

namespace App\Jobs;

use File;
use Image;
use App\Models\Portfolio;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UploadPortfolioImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $portfolio;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $disk = 'public';
        $filename = $this->portfolio->image;
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
                ->put('uploads/portfolios/original/'.$filename, fopen($original_file, 'r+'))){
                    File::delete($original_file);
                }
            //thumbnail
            if(Storage::disk($disk)
                ->put('uploads/portfolios/thumbnail/'.$filename, fopen($thumbnail, 'r+'))){
                File::delete($thumbnail);
            }
            //large
            if(Storage::disk($disk)
                ->put('uploads/portfolios/large/'.$filename, fopen($large, 'r+'))){
                File::delete($large);
            }
        
    }
}
