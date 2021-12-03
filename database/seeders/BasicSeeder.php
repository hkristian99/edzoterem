<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Role;
use App\Models\Post_status;
use App\Models\Address_type;
use App\Models\Order_status;
use App\Models\Paymode;
use App\Models\Category;
use App\Models\Room;
use App\Models\Shipping_mode;
use App\Models\UserStatus;

class BasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TÖMB VÁLTOZÓK
        $roles = array("Adminisztrátor","Edző", "Munkatárs", "Látogató", "Könyvelő");
        $post_statuses = array("Jóváhagyásra vár","Jóváhagyott","Piszkozat");
        $address_types = array("Számlázási", "Szállítási");
        $order_statuses = array("Beérkezett", "Feldolgozás alatt", "Teljesített", "Lemondott");
        $paymodes = array("Online fizetés","Utánvét","Készpénzzel vagy bankkártyával átvételkor");
        $categories = array("Bérlet","Napijegy","Étrend-kiegészítő","Felszerelés");
        $rooms = array("Nagy", "Közepes", "Kis", "Spinning");
        $shipping_modes = array("Személyesen üzletünkben", "Szállítás GLS futárszolgálattal", "On-line átvétel");
        $user_statuses = array("Aktív", "Inaktív", "Jelszó változtatás kötelező");
        
        
        //DB FELTÖLTÉSE BASIC ADATOKKAL
            //ORSZÁGOK TÁBLA
            $handle = fopen(base_path()."/database/seeders/countries.txt", "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    $newItem = new Country();
                    $newItem->name = $line;
                    $newItem->save();
                }
                fclose($handle);
            }

            //ROLES TÁBLA
            foreach($roles as $item) {
                $newItem = new Role();
                $newItem->name = $item;
                $newItem->save();
            }
            
            //POST_STATUSES TÁBLA
            foreach($post_statuses as $item) {
                $newItem = new Post_status();
                $newItem->name = $item;
                $newItem->save();
            }

            //ADDRESS_TYPES TÁBLA
            foreach($address_types as $item) {
                $newItem = new Address_type();
                $newItem->name = $item;
                $newItem->save();
            }

            //ORDER_STATUSES TÁBLA
            foreach($order_statuses as $item) {
                $newItem = new Order_status();
                $newItem->status = $item;
                $newItem->save();
            }

            //PAYMODES TÁBLA
            foreach($paymodes as $item) {
                $newItem = new Paymode();
                $newItem->name = $item;
                $newItem->save();
            }

            //CATEGORIES TÁBLA
            foreach($categories as $item) {
                $newItem = new Category();
                $newItem->name = $item;
                $newItem->save();
            }

            //ROOMS TÁBLA
            foreach($rooms as $item) {
                $newItem = new Room();
                $newItem->name = $item;
                $newItem->capacity = 25;
                $newItem->save();
            }
            
            //SHIPPING_MODES TÁBLA
            foreach($shipping_modes as $item) {
                $newItem = new Shipping_mode();
                $newItem->name = $item;
                $newItem->price = 0;
                $newItem->save();
            }
            //USER_STATUS TÁBLA
            foreach($user_statuses as $item) {
                $newItem = new UserStatus();
                $newItem->name = $item;
                $newItem->save();
            }
    }
}
