<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = 0;
        $subtotal = 0;

        return view("Public.Webshop.Cart")
        ->with("total",$total)
        ->with("subtotal",$subtotal);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request){

        $product = Product::findOrFail($request->id);
        $cart = session()->get('cart', []);
        $discount_price = 0;
        if($product->discount_price != null){
           $discount_price = $product->discount_price;
        }

        if( isset( $cart[$request->id] ) ){
            $cart[$request->id]['quantity']=$cart[$request->id]['quantity'] + $request->quantity;
        }
        else{
            $cart[$request->id] = [
                "name" => $product->name,
                "quantity" => $request->quantity,
                "list_price" => $product->list_price,
                "image" => $product->getFirstImage($product->id),
                "discount_price" => $discount_price
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'A termék sikeresen hozzáadva a kosárhoz!');
    }

    public function update(Request $request)
    {
        $quantity = intval($request->productQuantity);

        if($request->productID && $quantity >= 1){
            
            $cart = Session::get('cart');
            $cart[$request->productID]["quantity"] = $quantity;
            session()->put('cart', $cart);
            
            return redirect()->back()->with("success","A kosár tartalma módosítva!");
        }
        else{
            return redirect()->back()->with("error",'Érvénytelen adatokat adtál meg!');
        }
    
    }
    public function removeFromCart($id){ 
        
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart); 
        }
        return redirect()->back()->with("success","A termék törölve a kosárból!");
    }
    
    public function cartToEmpty(){
        session()->forget("cart");

        return redirect()->route('cart')->with("success","A kosár üres!");
    }
}
