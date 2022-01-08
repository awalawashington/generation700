<?php

namespace App\Http\Controllers\BlogPosts;

use App\Models\Comment;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function store(Request $request, $slug)
    {
        //validate request
        $request->validate([
            'body' => ['string', 'required'],
            'name' => ['string', 'required'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $blog = BlogPost::where('slug', '=', $slug)->firstOrFail();


        //create the database record for the post comment
        $blog->comments()->create([
            'name' => $request->name,
            'email' => $request->email,
            'body' => $request->body,
            'comment_ip' => $request->ip()
        ]);

        return redirect()->route('blog', ['slug' => $blog->slug.'#comments']);
        
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('success','Comment Deleted');

    }


    protected function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }

}
