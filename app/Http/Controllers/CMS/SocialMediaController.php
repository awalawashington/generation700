<?php

namespace App\Http\Controllers\CMS;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialMediaController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'facebook' => 'string',
            'twitter' => 'string',
            'instagram' => 'string',
            'linked_in' => 'string'
        ]);

        $social_media = SocialMedia::findOrFail($id);

        $social_media->update([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'linked_in' => $request->linked_in
        ]);
        
        $social_media = $social_media->refresh();


        return redirect()->back()->with('success','Successfully updated');
    }
}
