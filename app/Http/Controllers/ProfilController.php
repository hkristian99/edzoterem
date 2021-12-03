<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\MessageBag;

use App\Models\Address;
use App\Models\Address_type;
use App\Models\User;
use App\Models\Country;

class ProfilController extends Controller
{
    //SZEMÉLYES ADATOK KEZELÉSE
        public function Profile(){
            
            //ország lista
            $countries = Country::all();

            //szállítási címek lista
            $shippingAddresses = Address::all()
                ->where("address_type", "=", 2)
                ->where("user_id", "=", Auth::user()->id);

            //számlázási címek lista
        $billingAddresses = Address::all()
                ->where("address_type", "=", 1)
                ->where("user_id", "=", Auth::user()->id);

            return view("Public.Profiles.Profile")
                    ->with("countries", $countries)
                    ->with("shippingAddresses", $shippingAddresses)
                    ->with("billingAddresses", $billingAddresses);
                    
        }

        public function ProfileUpdate(Request $request){
        
            $user = User::findOrFail(Auth::user()->id);

            //1. validálás
            $rules = [
                "firstname" => "required",
                "lastname" => "required",
                "email" => "required",
            ];

            if ( $user->email != $request->email )
                $rules["email"] = "required|email|unique:users";


            $messages = [
                "firstname.required" => "A vezetéknév mező kitöltése kötelező!",
                "lastname.required" => "A keresztnév mező kitöltése kötelező!",
                "email.required" => "Az e-mail cím mező kitöltése kötelező!",
                "email.unique" => "A megadott e-mail cím már létezik, válasszon másikat!",
                "email.email" => "Az e-mail cím formátuma hibás!",
                "password.required" => "A jelszó mező kitöltése kötelező!",
                "password.confirmed" => "A két beírt jelszó nem egyezik meg!",
                
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ( $validator->fails() )
                return back()
                    ->withErrors($validator, "personalError")
                    ->withInput();


            // 2. kép feltöltés
            if ( $request->student_card_front ) {
                $path = public_path()."/images/student_cards/".$request->student_card_front;
                //dd($request->student_card_front);
                if ( file_exists($path) ) 
                    unlink($path);
            
                $image = $request->file('student_card_front');
                $imageInfo = pathinfo($image->getClientOriginalName());
                $imageName = \Carbon\Carbon::now()->format("U").Str::slug($user->firstname."_".$user->lastname."_diakigazolvany_elolap").".".$imageInfo['extension'];
                $destinationPath = public_path('/images/student_cards/');
                $image->move($destinationPath, $imageName);
                
                $user->student_card_front = $imageName;
            }

            if ( $request->student_card_back ) {
                $path = public_path()."/images/student_cards/".$request->student_card_back;
                if ( file_exists($path) ) 
                    unlink($path);

                $image = $request->file('student_card_back');
                $imageInfo = pathinfo($image->getClientOriginalName());
                $imageName = \Carbon\Carbon::now()->format("U").Str::slug($user->firstname."_".$user->lastname."_diakigazolvany_hatlap").".".$imageInfo['extension'];
                $destinationPath = public_path('/images/student_cards/');
                $image->move($destinationPath, $imageName);

                $user->student_card_back = $imageName;
            }

            //3. user update

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            if($request->student_card_number)
                $user->student_card_number = $request->student_card_number;

            $user->save();

            return redirect()->route("profile")->with("successPersonal", "A módosításokat elmentettük.");
        }
    //SZÁMLÁZÁSI ADATOK KEZELÉSE
        public function BillingAddressNew(Request $request){
            //1. validálás
            $rules = [
                "billing_name" => "required",
                "billing_postcode" => "required",
                "billing_city" => "required",
                "billing_street" => "required",
            ];
            if($request->billing_type == 2)
                $rules["tax_number"] = "required";

            $messages = [
                "billing_name.required" => "A név megadása kötelező!",
                "billing_postcode.required" => "Az irányítószám megadása kötelező!",
                "billing_city.required" => "A város megadása kötelező!",
                "billing_street.required" => "Az utca, házszám megadása kötelező!",
                "tax_number.required" => "Cégként az adószám megadása kötelező!"
            ];
        
            $validator = Validator::make($request->all(), $rules, $messages);

            if ( $validator->fails() )
                return redirect(url()->previous() . '#billingDiv')
                    ->withErrors($validator,"billingError")
                    ->withInput();

            $address = new Address();
            $address->user_id = Auth::user()->id;
            $address->address_type = 1;
            $address->name = $request->billing_name;
            $address->country_id = $request->billing_country_id;
            $address->postcode = $request->billing_postcode;
            $address->city = $request->billing_city;
            $address->street = $request->billing_street;
            $address->tax_number = $request->tax_number;

            $address->save();

            return redirect()->route("profile", "#billingDiv")->with("successBilling", "Az új számlázási cím felvételre került.");
        }

        public function BillingAddressUpdate(Request $request){
            $address = Address::findorFail($request->billingAddressId);
            
            //1. validálás
            $rules = [
                "billing_name" => "required",
                "billing_postcode" => "required",
                "billing_city" => "required",
                "billing_street" => "required",
            ];
            if($request->billing_type == 2)
                $rules["tax_number"] = "required";

            $messages = [
                "billing_name.required" => "A név megadása kötelező!",
                "billing_postcode.required" => "Az irányítószám megadása kötelező!",
                "billing_city.required" => "A város megadása kötelező!",
                "billing_street.required" => "Az utca, házszám megadása kötelező!",
                "tax_number.required" => "Cégként az adószám megadása kötelező!"
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ( $validator->fails() )
                return redirect(url()->previous() . '#billingDiv')
                    ->withErrors($validator,"billingError")
                    ->withInput();
            
            $address->user_id = Auth::user()->id;
            $address->address_type = 1;
            $address->name = $request->billing_name;
            $address->country_id = $request->billing_country_id;
            $address->postcode = $request->billing_postcode;
            $address->city = $request->billing_city;
            $address->street = $request->billing_street;
            $address->tax_number = $request->tax_number;
            $address->save();

            return redirect()->route("profile", "#billingDiv")->with("successBilling", "A számlázási cím módosítása sikeres volt.");
            
        }

        public function BillingAddressDelete(Request $request){
            
            $address = Address::findorFail($request->billingAddressId);
            $address->delete();

            return redirect()->route("profile", "#billingDiv")->with("successBilling", "A kijelölt számlázási cím törölve lett.");
        }

    //SZÁLLÍTÁSI ADATOK KEZELÉSE
        public function ShippingAddressNew(Request $request){
            //1. validálás
            $rules = [
                "shipping_name" => "required",
                "shipping_postcode" => "required",
                "shipping_city" => "required",
                "shipping_street" => "required"
            ];

            $messages = [
                "shipping_name.required" => "A név megadása kötelező!",
                "shipping_postcode.required" => "Az irányítószám megadása kötelező!",
                "shipping_city.required" => "A város megadása kötelező!",
                "shipping_street.required" => "Az utca, házszám megadása kötelező!"
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ( $validator->fails() )
                return redirect(url()->previous() . '#shippingDiv')
                    ->withErrors($validator,"shippingError")
                    ->withInput();

            $address = new Address();
            $address->user_id = Auth::user()->id;
            $address->address_type = 2;
            $address->name = $request->shipping_name;
            $address->postcode = $request->shipping_postcode;
            $address->city = $request->shipping_city;
            $address->street = $request->shipping_street;
            $address->phone = $request->shipping_phone;
            $address->note = $request->shipping_note;
            $address->save();

            return redirect()->route("profile", "#shippingDiv")->with("successShipping", "Az új szállítási cím felvételre került.");
        }

        public function ShippingAddressUpdate(Request $request){
            $address = Address::findorFail($request->shippingAddressId);
            
            //1. validálás
            $rules = [
                "shipping_name" => "required",
                "shipping_postcode" => "required",
                "shipping_city" => "required",
                "shipping_street" => "required"
            ];

            $messages = [
                "shipping_name.required" => "A név megadása kötelező!",
                "shipping_postcode.required" => "Az irányítószám megadása kötelező!",
                "shipping_city.required" => "A város megadása kötelező!",
                "shipping_street.required" => "Az utca, házszám megadása kötelező!"
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ( $validator->fails() )
                return redirect(url()->previous() . '#shippingDiv')
                    ->withErrors($validator,"shippingError")
                    ->withInput();

            
            $address->user_id = Auth::user()->id;
            $address->address_type = 2;
            $address->name = $request->shipping_name;
            $address->postcode = $request->shipping_postcode;
            $address->city = $request->shipping_city;
            $address->street = $request->shipping_street;
            $address->phone = $request->shipping_phone;
            $address->note = $request->shipping_note;
            $address->save();

            return redirect()->route("profile", "#shippingDiv")->with("successShipping", "A szállítási cím módosítása sikeres volt.");
        }

        public function ShippingAddressDelete(Request $request){
            $address = Address::findorFail($request->shippingAddressId);
            $address->delete();

            return redirect()->route("profile", "#shippingDiv")->with("successShipping", "A kijelölt szállítási cím törölve lett.");
        }
}
