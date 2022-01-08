<?php

namespace App\Http\Controllers\CMS;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Jobs\UploadPortfolioImage;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'portfolio_category_id' => 'required|numeric',
            'image' => 'required|mimes:jpeg,gif,bmp,png|max:2048',
            'title' => ['required', 'unique:portfolios,title', 'max:60'],
            'description' => ['string', 'required']
        ]);

        $image = $request->file('image');
        $image_path = $image->getPathName();

        //get the original file name and replace any spaces with _
        $filename = time()."_".  preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
        
        //move image to the temporary storage
        $tmp = $image->storeAs('uploads/original', $filename, 'tmp');


        $portfolio = Portfolio::create([
            'image' => $filename,
            'title' => $request->title,
            'description' => $request->description,
            'portfolio_category_id' => $request->portfolio_category_id
        ]);
        


        //dispatch a job to handle the image manipulation
        $this->dispatch(new UploadPortfolioImage($portfolio));

        return redirect()->back()->with('success','Successfully created');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'portfolio_category_id' => 'required|numeric',
            'title' => ['required', 'unique:portfolios,title,'.$id, 'max:60'],
            'description' => ['string', 'required']
        ]);

        $portfolio = Portfolio::findOrFail($id);


        $portfolio->update([
            'title' => $request->title,
            'description' => $request->description,
            'portfolio_category_id' => $request->portfolio_category_id
        ]);



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

        $portfolio = Portfolio::findOrFail($id);

        $portfolio->update([
            'image' => $filename,
        ]);
        
        $portfolio = $portfolio->refresh();


        //dispatch a job to handle the image manipulation
        $this->dispatch(new UploadPortfolioImage($portfolio));

        return redirect()->back()->with('success','Successfully updated');
    }

    public function destroy(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->delete();
        return redirect()->back()->with('success','Successfully deleted');
    }

}
