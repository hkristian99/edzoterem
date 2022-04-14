<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Taki47\Otpsimplepay\SimplePayStart;
use Taki47\Otpsimplepay\SimplePayBack;

use App\Models\Address;
use App\Models\Address_type;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Country;
use App\Models\Product;

use App\Mail\OrderMail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session('cart'))
            abort(404);
        
        $user = Auth::user();
        $total = 0;
        $subtotal = 0;
        $billing_addresses = [];
        $shipping_addresses = [];
        $countries = Country::all();
        
        if ($user) {
            $billing_addresses = Address::where("user_id",$user->id)->where("address_type",1)->get();
            $shipping_addresses = Address::where("user_id",$user->id)->where("address_type",2)->get();
        }
       
        return view("Public.Webshop.PersonalInfo")
            ->with("total",$total)
            ->with("subtotal",$subtotal)
            ->with("billing_addresses",$billing_addresses)
            ->with("shipping_addresses",$shipping_addresses)
            ->with("countries",$countries);
    }
    public function personalInfoTicket($id)
    {
        $ticket=Product::findOrFail($id);
        //TODO:jogosultság
        
        $user = Auth::user();
        $total = 0;
        $subtotal = 0;
        $billing_addresses = [];
        $countries = Country::all();
        
        if ($user) {
            $billing_addresses = Address::where("user_id",$user->id)->where("address_type",1)->get();
        }
       
        return view("Public.Webshop.PersonalInfoTickets")
            ->with("total",$total)
            ->with("subtotal",$subtotal)
            ->with("billing_addresses",$billing_addresses)
            ->with("countries",$countries)
            ->with("ticket",$ticket);
    }

    public function store(Request $request){
        $user = Auth::user();
        $total = 0;
        $subtotal = 0;
        $order_items = session()->get('cart');

        foreach ($order_items as $id => $item) {
            $order_itemIDs[] = 
                [ 
                "id" => $id,
                "quantity" => $item["quantity"] 
                ];
        };
        // meta adatok eltárolása bankkártyás fizetéshez
        $email = "";
        if ( Auth::check() )
            $email = Auth::user()->email;

        $billingAddress  = null;
        $shippingAddress = null;
       
        /*ADATOK VALIDÁLÁSA*/
        //nincs bejelentkezve
        if(!Auth::check()){
            $rules = [
                "billing_name" => "required",
                "billing_postcode" => "required",
                "billing_city" => "required",
                "billing_street" => "required",

                "shipping_name" => "required",
                "shipping_postcode" => "required",
                "shipping_city" => "required",
                "shipping_street" => "required",
                "shipping_phone" => "required",
                "shipping_email" => "required",
                
                "paymode" => "required",
                "accept" => "required",
            ];
        }

        //be van jelentkezve, de új számlázási címet vesz fel
        elseif( Auth::check() && !$request->billingAddressID ){
            $rules = [
                "billing_name" => "required",
                "billing_postcode" => "required",
                "billing_city" => "required",
                "billing_street" => "required",

                "paymode" => "required",
                "accept" => "required",
            ];   
            if(!$request->shippingAddressID){
                $rules = [
                    "shipping_name" => "required",
                    "shipping_postcode" => "required",
                    "shipping_city" => "required",
                    "shipping_street" => "required",
                    "shipping_phone" => "required",
    
                    "paymode" => "required",
                    "accept" => "required",
                ];
            };
        }

        //be van jelentkezve, de új szállítási címet vesz fel
        elseif(Auth::check() && !$request->shippingAddressID){
            $rules = [
                "shipping_name" => "required",
                "shipping_postcode" => "required",
                "shipping_city" => "required",
                "shipping_street" => "required",
                "shipping_phone" => "required",

                "paymode" => "required",
                "accept" => "required",
            ];
            if(!$request->billingAddressID){
                $rules = [
                    "billing_name" => "required",
                    "billing_postcode" => "required",
                    "billing_city" => "required",
                    "billing_street" => "required",
    
                    "paymode" => "required",
                    "accept" => "required",
                ]; 
            };
        }
        //be van jelentkezve ÉS nincs új számlázási VAGY szállítási cím
        else{
            $rules = [
                "billingAddressID" => "required",
                "shippingAddressID" => "required",

                "paymode" => "required",
                "accept" => "required",
            ];
        };

        if($request->billingTypeID){
            $rules["taxNumber"] = "required";
        };
            
        $messages = [
            "billing_name.required" => "Számlázási cím pontos megadása kötelező! (Hiba: Név)",
            "billing_postcode.required" => "Számlázási cím pontos megadása kötelező! (Hiba: Irányítószám)",
            "billing_city.required" => "Számlázási cím pontos megadása kötelező! (Hiba: Város)",
            "billing_street.required" => "Számlázási cím pontos megadása kötelező! (Hiba: Utca)",
            "taxNumber.required" => "Számlázási cím pontos megadása kötelező! (Hiba: Adószám)",

            "shipping_name.required" => "Szállítási cím pontos megadása kötelező! (Hiba: Név)",
            "shipping_postcode.required" => "Szállítási cím pontos megadása kötelező! (Hiba: Irányítószám)",
            "shipping_city.required" => "Szállítási cím pontos megadása kötelező! (Hiba: Város)",
            "shipping_street.required" => "Szállítási cím pontos megadása kötelező! (Hiba: Utca)",
            "shipping_phone.required" => "Szállítási cím pontos megadása kötelező! (Hiba: Telefonszám)",
            "shipping_email.required" => "Szállítási cím pontos megadása kötelező! (Hiba: Email-cím)",

            "billingAddressID.required" => "Számlázái cím kiválasztása kötelező!",
            "shippingAddressID.required" => "Szállítási cím kiválasztása kötelező!",

            "paymode.required" => "A fizetés módjának megadása kötelező!",
            "accept.required" => "Az Vásárlási feltételek és az Adatvédelmi nyilatkozat elfogadása kötelező!"
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        if ( $validator->fails() )
            return back()
                ->withErrors($validator, "personalDataError")
                ->withInput();

        //számlázási és szállítási cím felvétele adatbázisba ha regisztrált a felhasználó {addresses}
            if(!$request->billingAddressID && Auth::check()){
                $billingAddress = new Address();
                $billingAddress->user_id = $user->id;
                $billingAddress->address_type = 1; //számlázási
                $billingAddress->country_id = $request->billing_country;
                $billingAddress->name = $request->billing_name;
                $billingAddress->postcode = $request->billing_postcode;
                $billingAddress->city = $request->billing_city;
                $billingAddress->street = $request->billing_street;
                if($request->billingTypeID)
                    $billingAddress->tax_number = $request->taxNumber;
                $billingAddress->save();
            };

            if(!$request->shippingAddressID && Auth::check()){
                $shippingAddress = new Address();
                $shippingAddress->user_id = $user->id;
                $shippingAddress->address_type = 2; //szállítási
                $shippingAddress->name = $request->shipping_name;
                $shippingAddress->postcode = $request->shipping_postcode;
                $shippingAddress->city = $request->shipping_city;
                $shippingAddress->street = $request->shipping_street;
                $shippingAddress->phone = $request->shipping_phone;
                $shippingAddress->note = $request->shipping_note;
                $shippingAddress->save();
            };

        //számlázási és szállítási cím felvétele adatbázisba ha  NEM regisztrált a felhasználó {addresses}
            //user_id = 0 - non-regist user ID-ja
            if(!Auth::check()){
                $billingAddress = new Address();
                $billingAddress->user_id = 0;
                $billingAddress->address_type = 1; //számlázási
                $billingAddress->country_id = $request->billing_country;
                $billingAddress->name = $request->billing_name;
                $billingAddress->postcode = $request->billing_postcode;
                $billingAddress->city = $request->billing_city;
                $billingAddress->street = $request->billing_street;
                if($request->billingTypeID)
                    $billingAddress->tax_number = $request->taxNumber;
                $billingAddress->save();

                $shippingAddress = new Address();
                $shippingAddress->user_id = 0;
                $shippingAddress->address_type = 2; //szállítási
                $shippingAddress->name = $request->shipping_name;
                $shippingAddress->email = $request->shipping_email;
                $shippingAddress->postcode = $request->shipping_postcode;
                $shippingAddress->city = $request->shipping_city;
                $shippingAddress->street = $request->shipping_street;
                $shippingAddress->phone = $request->shipping_phone;
                $shippingAddress->note = $request->shipping_note;
                $shippingAddress->save();

                $email = $request->shipping_email;
            };
        
        //rendelés rögzítése adatbázisban a már felvett VAGY kiválasztott címekkel {orders}
            $order=new Order();
            if(!$request->billingAddressID){
                $order->address_billing_id = $billingAddress->id;
            }
            else{
                $order->address_billing_id = $request->billingAddressID;
                $billingAddress = Address::find($request->billingAddressID);
            };

            if(!$request->shippingAddressID){
                $order->address_shipping_id = $shippingAddress->id;
            }
            else{
                $order->address_shipping_id = $request->shippingAddressID;
                $shippingAddress = Address::find($request->shippingAddressID);
            };
            $order->shipping_mode_id = 2;

        //rendelés státusza fizetési mód alapján
            //utánvét 
            if($request->paymode == 3){
                $order->order_status_id = 1; //"Rögzített"
            }
            //online vagy banki utalás
            else{
                $order->order_status_id = 5; //"Fizetésre vár"
            };
            $order->grandtotal = 0;
            $order->shipping_fee = 0;
            $order->subtotal = 0;
            $order->paymode_id = $request->paymode; 
            $order->note = $request->noteForGym; 

        //regisztrált VAGY nem regisztrált felhasználó
            if(Auth::check()){
                $order->user_id = $user->id;
            }
            else{
                $order->user_id = 0;
            };
            $order->save();

        //rendeléshez tartozó TERMÉKEK rögzítése {order_items}
        $grandTotal = 0;
        
        // simplepay-hez adatok
        $simplePayProducts = [];

        foreach ($order_itemIDs as $itemID) {
            $item = Product::find($itemID["id"]);
            if( $item->discount_price ) {
                $price = $item->discount_price;
            } else {
                $price = $item->list_price;
            }
            
            $orderItem = new Order_item();
            $orderItem->quantity = $itemID["quantity"];
            $orderItem->price = $price;
            $orderItem->amount = $itemID["quantity"] * $price;
            $orderItem->product_id = $itemID["id"];
            $orderItem->order_id = $order->id;
            $orderItem->save();

            // végösszeghez hozzáadás
            $grandTotal = $grandTotal + ($itemID["quantity"] * $price);

            //simplepay-hez adatok
            $tmp = [
                'ref' => $item->name,
                'title' => $item->name,
                'description' => $item->description,
                'amount' => $itemID["quantity"],
                'price' => $price,
                'tax' => '0',
            ];
            array_push($simplePayProducts, $tmp);
        }


        // szállítási díj meghatározása
        $shipping_fee = 0;
        if ( $grandTotal<18000 ) {
            $shipping_fee = 750;
        }

        // order táblában grandtotal frissítése
        $order->subtotal = $grandTotal;
        $order->shipping_fee = $shipping_fee;
        $order->grandtotal = $grandTotal+$shipping_fee;
        $order->save();
        
        if( $request->paymode == "3" || $request->paymode == "2" ) {
            // utánvét fizetés
            session()->forget("cart");
            Self::sendEmail($order->id);
            return redirect()->route("orderDetails", $order->id);
        } else {
            // simplepay fizetés
            $simplePay = new SimplePayStart();

            //TWO STEP AUTH
            $simplePay->addData("twoStep", false);
                    
            // ORDER REFERENCE NUMBER
            // uniq oreder reference number in the merchant system
            $simplePay->addData('orderRef', str_replace(array('.', ':', '/'), "", @$_SERVER['SERVER_ADDR']) . @date("U", time()) . rand(1000, 9999));

            // customer's registration mehod
            // 01: guest
            // 02: registered
            // 05: third party
            $simplePay->addData('threeDSReqAuthMethod', '02');

            // EMAIL
            // customer's email
            $simplePay->addData('customerEmail', $email);

            // METHODS
            // CARD or WIRE
            $simplePay->addData('methods', array('CARD'));

            //ORDER ITEMS
            foreach ($simplePayProducts as $simplePayProduct) {
                $simplePay->addItems(
                    array(
                        'ref' => $simplePayProduct["ref"],
                        'title' => $simplePayProduct["title"],
                        'description' => $simplePayProduct["description"],
                        'amount' => $simplePayProduct["amount"],
                        'price' => $simplePayProduct["price"],
                        'tax' => '0',
                        )
                );
            }
            
            
            // SHIPPING COST
            $simplePay->addData('shippingCost', $shipping_fee);
            
            // INVOICE DATA
            $simplePay->addGroupData('invoice', 'name', $billingAddress->name);
            $simplePay->addGroupData('invoice', 'company', $billingAddress->name);
            $simplePay->addGroupData('invoice', 'country', $billingAddress->country->name);
            $simplePay->addGroupData('invoice', 'state', $billingAddress->city);
            $simplePay->addGroupData('invoice', 'city', $billingAddress->city);
            $simplePay->addGroupData('invoice', 'zip', $billingAddress->postcode);
            $simplePay->addGroupData('invoice', 'address', $billingAddress->street);

            // DELIVERY DATA
            $simplePay->addGroupData('delivery', 'name', $shippingAddress->name);
            $simplePay->addGroupData('delivery', 'company', $shippingAddress->name);
            $simplePay->addGroupData('delivery', 'country', $billingAddress->country->name);
            $simplePay->addGroupData('delivery', 'state', $shippingAddress->city);
            $simplePay->addGroupData('delivery', 'city', $shippingAddress->city);
            $simplePay->addGroupData('delivery', 'zip', $shippingAddress->postcode);
            $simplePay->addGroupData('delivery', 'address', $shippingAddress->street);
            $simplePay->addGroupData('delivery', 'phone', $shippingAddress->phone);

            //create transaction in SimplePay system
            $simplePay->runStart();

            $returnData = $simplePay->getReturnData();

            //tranzaction_id to table
            $order->tranzaction_id = $returnData["transactionId"];
            $order->save();


            return redirect($returnData["paymentUrl"]);
        };
    }

    public function orderDetails($id){
        $order = Order::findOrFail($id);
        /*TODO: if(!Auth::check() || (Auth::user()->id != $order->user_id))
            abort(404);
        */
        $order_items = Order_item::where("order_id", $id)->get();
        $billingData = Address::where("id", $order->address_billing_id)->first()->toarray();
        $shippingData = Address::where("id", $order->address_shipping_id)->first()->toarray();
        //dd($order, $order_items, $billingData, $shippingData);

        return view("Public.Webshop.OrderDetails")
        ->with("order",$order)
        ->with("order_items",$order_items)
        ->with("billingData",$billingData)
        ->with("shippingData",$shippingData);
       
    }
    public function thankYou(){
       
        if(Auth::check())
            abort(404);

        $order = session()->get("order");
        $email = session()->get("email");

        session()->forget("order");
        session()->forget("email");

        if(!$order)
            abort(404);
            
        return view("Public.Webshop.ThankYou")
            ->with("order",$order)
            ->with("email",$email);
    }
    public function simplepayFail($id){
        $order = Order::findOrFail($id);
        $reason = session()->get("reason");
        /*TODO:if(!Auth::check() || (Auth::user()->id != $order->user_id))
            abort(404);
        */
        return view("Public.Webshop.SimplepayFail")
            ->with("order",$order)
            ->with("reason",$reason);
    }

    public function PayResult(Request $request)
    {
        $simplePayBack = new SimplePayBack();

        $result = array();
        if (isset($request->r) && isset($request->s)) {
            if ($simplePayBack->isBackSignatureCheck($request->r, $request->s)) {
                $result = $simplePayBack->getRawNotification();
            }
        }

        $tranzakciosId = $result["t"];
        $valasz = $result["e"];
        //dd($result);

        switch ($valasz) {
            case "SUCCESS":
                /**
                 * SIKERES: orders-ben státusz KIFIZETVE (CSAK EZ TESZTEN!!!!), e-mail küldés, köszönet oldal (tranzakciós azonosító feltűntetésével), kosár ürítése
                 */
                $order = Order::where("tranzaction_id", $tranzakciosId)->first();
                $order->order_status_id = 2;
                $order->save();
                session()->forget("cart");
                
                Self::sendEmail($order->id);

                return redirect()->route("orderDetails", $order->id);
                break;
            case "FAIL":
                /*
                 sikertelen fizetés, orders-ben státusz SZTORNÓ,  (tranzakciós azonosító feltűntetésével), és felajánlani, hogy újra leadhatja a megrendelését
                 */
                $order = Order::where("tranzaction_id", $tranzakciosId)->first();
                $order->order_status_id = 3;
                $order->save();

                $reason= "Sikertelen tranzakció.";
                session()->put("reason", $reason);

                return redirect()->route("simplepayFail", $order->id);
                break;
            case "CANCEL":
                /**
                 * megszakított fizetés, orders-ben státusz SZTORNÓ,felajánlani (tranzakciós azonosító feltűntetésével) hogy újra leadhatja a megrendelését
                 */
                $order = Order::where("tranzaction_id", $tranzakciosId)->first();
                $order->order_status_id = 3;
                $order->save();

                $reason= "Vásárló által megszüntetett tranzakció.";
                session()->put("reason", $reason);

                return redirect()->route("simplepayFail", $order->id);
                break;
            case "TIMEOUT":
                /**
                 * időtúllépés, orders-ben státusz SZTORNÓ, felajánlani (tranzakciós azonosító feltűntetésével), hogy újra leadhatja a megrendelését
                 */
                $order = Order::where("tranzaction_id", $tranzakciosId)->first();
                $order->order_status_id = 3;
                $order->save();

                $reason= "Sikertelen tranzakció, időtúllépés miatt.";
                session()->put("reason", $reason);

                return redirect()->route("simplepayFail", $order->id);
                break;
            default:
                break;
        }

    }


    public function sendEmail($orderId)
    {
        $order        = Order::find($orderId);
        $order_items  = Order_item::where("order_id", $orderId)->get();
        $billingData  = Address::where("id", $order["address_billing_id"])->first();
        $shippingData = Address::where("id", $order["address_shipping_id"])->first();

        $orderData = [
            "order" => $order,
            "items" => $order_items,
            "billing" => $billingData,
            "shipping" => $shippingData
        ];
        

        \Mail::to($shippingData->email)->send(new OrderMail($orderData));
    }
}
