<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Post_tag;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where("post_status_id", '<>', 3)->get();
        $approvePostNumber = 0;

        foreach ($posts as $post) {
            if ($post->post_status_id == 1 ) {
                $approvePostNumber = $approvePostNumber + 1;
            }
        }
        
        return view("Admin.Blogs.IndexAll")
            ->with("posts", $posts)
            ->with("approvePostNumber", $approvePostNumber);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByUser()
    {
        $posts = Post::where("user_id", Auth::user()->id)
            ->get();

    return view("Admin.Blogs.Index")
        ->with("posts", $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::orderBy("name")->get();
        return view('Admin.Blogs.Create')
            ->with("tags", $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1. validálás
        if($request->has('draft')){
            $rules = [
                "title" => "required|unique:posts",
            ];

        }else{
            //TODO: ha túl hosszú a lead akkor is hibaüzenettel térjen vissza!
            $rules = [
                "title" => "required|unique:posts",
                "lead" => "required",
                "body" => "required",
                "cover" => "required"
            ];
        }
        $messages = [
            "title.required" => "A cím mező kitöltése kötelező!",
            "title.unique" => "A megadott cím már létezik, válasszon másikat!",
            "lead.required" => "A bevezető mező kitöltése kötelező!",
            "body.required" => "A szövegtörzs mező nem lehet üres!",
            "cover.required" => "Boritókép feltöltése kötelező!"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ( $validator->fails() )
            //TODO: képet ne töltse fel ilyenkor.
            return back()
                ->withErrors($validator)
                ->withInput();

        //kép feltöltés
        $imageName = "";
        
        if($request->cover){
            $image = $request->file('cover');
            $imageInfo = pathinfo($image->getClientOriginalName());
            $imageName = \Carbon\Carbon::now()->format("U").Str::slug($request->cover).".".$imageInfo['extension'];
            $destinationPath = public_path('/images/posts');
            $image->move($destinationPath, $imageName);

            $imageName = "/images/posts/".$imageName;
        }
        
        $lead = "";
        if($request->lead)
            $lead = $request->lead;

        $body = "";
        if($request->body)
            $body = $request->body;

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->lead = $lead;
        $post->body = $body;
        $post->user_id = Auth::user()->id;
        $post->post_status_id = 1;
        $post->cover = $imageName;

        if($request->has('draft'))
            $post->post_status_id = 3;
        
        $post->save();
        
        
        //TAG-ek felvétele
        $tags = $request->tags;
        $post->tag()->sync($tags);
        
        if($post->post_status_id = 3)
            return redirect()->route("blogByUser")->withSuccess("A bejegyzés mentése sikerült! Státusza 'Piszkozat'-ra módosult!");

        return redirect()->route("blogByUser")->withSuccess("A bejegyzés létrehozása sikerült! Státusza 'Jóváhagyásra vár'-ra módosult!");
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $post_tags = Post_tag::where("post_id", $id)->pluck("tag_id")->toArray();
        $tags = Tag::orderBy("name")->get();
        
        return view('Admin.Blogs.Edit')
                    ->with('post', $post)
                    ->with('tags', $tags)
                    ->with('post_tags', $post_tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        //1. validálás
        $rules = [
            "title" => "required|max:255",
        ];
        if($request->has('publish')){
            if ( $post->lead != $request->lead)
                $rules["lead"] = "required|max:500";

            if ( $post->body != $request->body)
                $rules["body"] = "required";

            if ( $post->title != $request->title )
                $rules["title"] = "required|unique:posts";

        }
        $messages = [
            "title.required" => "A cím mező kitöltése kötelező!",
            "title.unique" => "A megadott cím már létezik, válasszon másikat!",
            "title.max" => "A cím maximális hossza :max karakter lehet!",
            "lead.required" => "A bevezető mező kitöltése kötelező!",
            "lead.max" => "A bevezető maximális hossza :max karakter lehet!",
            "body.required" => "A szövegtörzs mező nem lehet üres!",
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ( $validator->fails() )
            return back()
                ->withErrors($validator)
                ->withInput();


        //kép feltöltés
        if ( $request->cover ) {
            if ( $post->cover!="" ) {
                $path = public_path()."/images/posts/".$post->cover;
                if ( file_exists($path) ) 
                    unlink($path);
            }

            $image = $request->file('cover');
            $imageInfo = pathinfo($image->getClientOriginalName());
            $imageName = \Carbon\Carbon::now()->format("U").Str::slug($request->cover).".".$imageInfo['extension'];
            $destinationPath = public_path('/images/posts');
            $image->move($destinationPath, $imageName);
            $post->cover = "/images/posts/".$imageName;
        }

        $lead = "";
        if($request->lead)
            $lead = $request->lead;

        $body = "";
        if($request->body)
            $body = $request->body;

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->lead = $lead;
        $post->body = $body;
        
        if($request->has('draft')){
            $post->post_status_id = 3;
        }else{
            $post->post_status_id = 1;
        }
        $post->save();

        //TAG-ek módosítása
        $tags = $request->tags;
        $post->tag()->sync($tags);


        if($post->post_status_id == 3)
            return redirect()->route("blogByUser")->withSuccess("A piszkozat mentése sikerült!");
        return redirect()->route("blogByUser")->withSuccess("A bejegyzés módosítása sikerült! Státusza 'Jóváhagyásra vár'-ra változott.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ( $post->delete() ) {
            return redirect()->route("blogByUser")->withSuccess("A bejegyzés törlése sikerült!");
        } else {
            return back()
                ->withErrors("A bejegyzés törlése nem sikerült")
                ->withInput();
        }
    }

    public function PostStatus(){
        $posts = Post::where("post_status_id", 1)
             ->paginate(20);

        $postStatusCount = Post::where("post_status_id", 1)
             ->count();

        return view("Admin.Blogs.PostStatus")
            ->with("posts", $posts)
            ->with("postStatusCount", $postStatusCount);
    }

    public function PostApproval($postID)
    {
        $post = Post::findOrFail($postID);
        $post->post_status_id = 2;
        $post->save();

        return redirect()
            ->route("blogAll")
            ->withSuccess("A jóváhagyás sikerült!");
    }

}