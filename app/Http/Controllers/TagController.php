<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;
use App\Models\Post_tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy("name")->get();

        return view("Admin.Tags.Index")
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
        $name = $request->name;

        if ( $name!="" ) {
            $isset = Tag::where("name", $name)->count();
            if ( $isset>0 ) {
                //TODO: hiba, létezik
            } else {
                $tag = new Tag();
                $tag->name = $name;
                $tag->slug = Str::slug($tag->name);

                $tag->save();

                return redirect()->route("tags")->withSuccess("Az új címke felvétele sikerült!");
            }
        } else {
            //TODO: hiba, nincs adat
        }
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
        $tag = Tag::findOrFail($id);
        $name = $request->name;

        if ( $tag->name != $name ) {
            $isset = Tag::where("name", $name)->count();
            if ( $isset>0 ) {
                //TODO: hiba, létezik
            }
        }

        $tag->name = $name;
        $tag->save();

        return redirect()->route("tags")->withSuccess("A címke módosítása sikerült!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->tagId;
        
        //post tags táblából törlés
        Post_tag::where("tag_id", $id)->delete();
        
        //tags táblából törlés
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route("tags")->withSuccess("A címke törlése sikerült!");
    }
}
