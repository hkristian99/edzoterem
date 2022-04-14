<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        $mainCategories = Category::where("parent_id", 0)->get();
        
        return view("Admin.WebShop.Category")
            ->with("categories", $categories)
            ->with("mainCategories", $mainCategories);
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $parent_id = $request->parentCategory;
        

        if ( $name!="" ) {
            $isset = Category::where("name", $name)->count();
            if ( $isset > 0 ) {
                //TODO: hiba, létezik
            } else {
                $category = new Category();
                $category->name = $name;
                $category->parent_id = $parent_id;
                $category->save();

                return redirect()->route("categoryIndex")->withSuccess("Az új kategória felvétele sikerült!");
            }
        } else {
            //TODO: hiba, nincs adat
        }
    }
    
    public function update(Request $request, $id){

        $category = Category::findOrFail($id);
        $name = $request->name;
        $parent_id = $request->parentCategory;

        if ( $category->name != $name ) {
            $isset = Category::where("name", $name)->count();
            if ( $isset>0 ) {
                //TODO: hiba, létezik
            }
        }
        $category->name = $name;
        $category->parent_id = $parent_id;
        $category->save();

        return redirect()->route("categoryIndex")->withSuccess("A kategória módosítása sikerült!");
    }
    public function destroy(Request $request){
        $id = $request->categoryId;
       
        //TODO: products táblából törlés
        
        //category táblából törlés
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route("categoryIndex")->withSuccess("A kategória törlése sikerült!");
    }
}
