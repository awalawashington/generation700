<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PortfolioCategory;
use App\Http\Controllers\Controller;

class PortfolioCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:portfolio_categories,name', 'max:60']
            
        ]);

        PortfolioCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->back()->with('success','Successfully created');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'unique:portfolio_categories,name,'.$id, 'max:60']
        ]);

        $portfolio_category = PortfolioCategory::findOrFail($id);

        $portfolio_category->update([
            'name' => $request->name
        ]);

        $portfolio_category = $portfolio_category->refresh();
        return redirect()->back()->with('success','Successfully updated');
    }

    public function destroy(Request $request, $id)
    {
        $category = PortfolioCategory::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success','Successfully Deleted');
    }
}
