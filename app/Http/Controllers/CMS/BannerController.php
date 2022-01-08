<?php

namespace App\Http\Controllers\CMS;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Jobs\UploadBannerImage;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'unique:banners,title,'.$id, 'max:60'],
            'description' => ['string', 'required']
        ]);

        $banner = Banner::findOrFail($id);

        $banner->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        
        $banner = $banner->refresh();

        return redirect()->back()->with('success','Successfully updated');
    }

    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,gif,bmp,png|max:2048',
        ]);

        $image = $request->file('image');
        $image_path = $image->getPathName();

        //get the original file name and replace any spaces with _
        $filename = time()."_".  preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
        
        //move image to the temporary storage
        $tmp = $image->storeAs('uploads/original', $filename, 'tmp');

        $banner = Banner::findOrFail($id);

        $banner->update([
            'image' => $filename,
        ]);
        
        $banner = $banner->refresh();


        //dispatch a job to handle the image manipulation
        $this->dispatch(new UploadBannerImage($banner));

        return redirect()->back()->with('success','Successfully updated');
    }
}
