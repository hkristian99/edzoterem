<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    public function index(){
        $manufacturers = Manufacturer::all();

        return view("Admin.WebShop.Manufacturer")
            ->with("manufacturers", $manufacturers);
    }
    public function store(Request $request)
    {
        $name = $request->name;

        if ( $name!="" ) {
            $isset = Manufacturer::where("name", $name)->count();
            if ( $isset>0 ) {
                //TODO: hiba, létezik
            } else {
                $manu = new Manufacturer();
                $manu->name = $name;
                $manu->save();

                return redirect()->route("manufacturerIndex")->withSuccess("Az új gyártó felvétele sikerült!");
            }
        } else {
            //TODO: hiba, nincs adat
        }
    }
    
    public function update(Request $request, $id){
        $manu = Manufacturer::findOrFail($id);
        $name = $request->name;

        if ( $manu->name != $name ) {
            $isset = Manufacturer::where("name", $name)->count();
            if ( $isset>0 ) {
                //TODO: hiba, létezik
            }
        }

        $manu->name = $name;
        $manu->save();

        return redirect()->route("manufacturerIndex")->withSuccess("A gyártó módosítása sikerült!");
    }
    public function destroy(Request $request){
        $id = $request->manufacturerId;
        
        //TODO: products táblából törlés
        
        //manufacturers táblából törlés
        $manu = Manufacturer::findOrFail($id);
        $manu->delete();

        return redirect()->route("manufacturerIndex")->withSuccess("A gyártó törlése sikerült!");
    }
}
