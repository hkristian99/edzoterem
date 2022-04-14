<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use \App\Models\Category;
use \App\Models\Manufacturer;

class WebshopBasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");

        Category::truncate();

        //DB feltöltése gyártókkal és kategóriákkal
        //VÁLTOZÓK
        $categories=[
            [
                "name" => "Táplálékkiegészítők",
                "childs" => [
                    "Fehérjék",
                    "Zsírégetők",
                    "Tömegnövelők és szénhidrátok",
                    "Izületvételem",
                    "Aminosavak",
                    "Vitaminok",
                    "Ásványi anyagok",
                    "Egészséges zsírok",
                    "Teljesítményfokozók",
                    "Kreatin",
                    "Egyéb táplálékkiegészítők",
                ],
            ],
            [
                "name" => "Egészséges élelmiszerek",
                "childs" => [
                    "Fitness élelmiszer",
                    "Gabonák és gabonapelyhek",
                    "Italok",
                    "Hozzávalók főzéshez",
                    "Fitness élelmiszer",
                ],
            ],
            [
                "name" => "Fitness ruházat",
                "childs" => [
                    "Női sportruházat",
                    "Férfi sportruházat",
                    "Kompressziós ruházat"
                ],
            ],
            [
                "name" => "Egyéb kategóriák"
            ],
        ];

        $manufacturers=["BioTechUSA","GymBeam","ForceGym","GYMSHARK","RHONE","RYDERWEAR","VOURI","ECHT"];


        foreach ($categories as $category) {
            $cat = new Category();
            $cat->name = $category["name"];
            $cat->parent_id = "0";
            $cat->save();

            if ( isset($category["childs"]) ) {
                foreach ($category["childs"] as $child) {
                    $catChild = new Category();
                    $catChild->name = $child;
                    $catChild->parent_id = $cat->id;
                    $catChild->save();
                }
            }
        }
        foreach ($manufacturers as $manufacturer) {
            $manu = new Manufacturer();
            $manu->name = $manufacturer;
            $manu->save();
        }


        DB::statement("SET foreign_key_checks=1");
    }
}
