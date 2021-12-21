<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use App\Models\Address;
use App\Models\Address_type;
use App\Models\User;
use App\Models\Country;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Post_tag;

class PublicController extends Controller
{
    public function Home(){
        return view("Public.Home");
    }

    public function Prices(){
        return view("Public.Library.Prices");
    }

    public function Bmi(){
        return view("Public.Library.BmiCalculator");
    }

    public function Blog(){
        $posts = Post::where("post_status_id", 2)->orderBy("created_at","desc")->paginate(5);
        $post_tags = Post_tag::all();

        return view("Public.Library.Blog.Blog")
            ->with("posts", $posts)
            ->with('post_tags', $post_tags);
    }

    public function BlogDetails($slug)
    {
        $post = Post::where("slug", $slug)->where("post_status_id", 2)->first();
        
        if( !$post )
            abort(404);

        $postsByUser = Post::where("user_id", $post->user_id)->where("post_status_id", 2)->orderBy("created_at","desc")->get();
        $post_tags = Post_tag::where("post_id", $post->id)->get();

        return view("Public.Library.Blog.BlogDetails")
            ->with("post", $post)
            ->with("postsByUser", $postsByUser)
            ->with('post_tags', $post_tags);
    }

    public function BlogBy($id)
    {
        $user=User::findOrFail($id);
        $posts = Post::where("post_status_id", 2)->where("user_id", $id)->orderBy("created_at","desc")->paginate(5);

        return view("Public.Library.Blog.BlogBy")
            ->with("user", $user)
            ->with("posts", $posts);
    }

    public function BlogByTag($tagName)
    {
        $tag = Tag::where("slug", $tagName)->first();
        $post_tags = Post_tag::where("tag_id", $tag->id)->pluck("post_id")->toArray();
        $posts = Post::where("post_status_id", 2)->whereIn("id",$post_tags)->orderBy("created_at","desc")->paginate(5);

        return view("Public.Library.Blog.BlogByTag")
            ->with("tag", $tag)
            ->with("posts", $posts)
            ->with('post_tags', $post_tags);
    }

    public function Classes(){
        return view("Public.Library.Classes");
    }

    public function Gallery(){
        return view("Public.Library.Gallery");
    }
    
    public function Contact(){
        return view("Public.Library.Contact");
    }
    public function Timetable(){
        return view("Public.Library.ClassTimetable");
    }

    public function Services(){
        return view("Public.Library.Services");
    }

   

}
