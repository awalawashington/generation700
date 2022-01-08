<?php

namespace App\Http\Controllers\CMS;

use App\Models\About;
use Illuminate\Http\Request;
use App\Jobs\UploadAboutImage;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'unique:abouts,title,'.$id, 'max:60'],
            'description' => ['string', 'required']
        ]);

        $about = About::findOrFail($id);

        $about->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        
        $about = $about->refresh();

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

        $about = About::findOrFail($id);

        $about->update([
            'image' => $filename,
        ]);
        
        $about = $about->refresh();


        //dispatch a job to handle the image manipulation
        $this->dispatch(new UploadAboutImage($about));

        return redirect()->back()->with('success','Successfully updated');
    }
}
