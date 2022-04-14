<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


use Faker\Factory as Faker;


use App\Models\Product;
use App\Models\Product_image;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        $category_id=4;
        $products=[
            /*[
                "name" => "CLA 1000 mg",
                "description" => "A CLA vagy konjugált linolsav egy természetes anyagcsere fokozó, mely hozzájárul a koleszterin megfelelő szinten tartásához a vérben.",
                "category_id" => "3",
            ],
            [
                "name" => "L-Karnitin TABS 100 tabl",
                "description" => "Az L-karnitin a karnitin leggyakoribb formája, amely természetéből eredően megtalálható az emberi test minden sejtjében Részt vesz a zsírsavak mitokondriummá történő átalakításában, amely energiát termel a sejt működéséhez. L-karnitin tabletta formában és praktikus 100 darabos kiszerelésben.",
                "category_id" => "3",
            ],
            [
                "name" => "Szinefrin",
                "description" => "A szinefrin a legeladottabb anyagcsere fokozó, egy rendkívül hatásos anyag, amely csökkenti a testsúlyt. Serkenti a hőtermelést, így meleget képez a testben, amivel növeli az energiakiadást fizikai leterheltség nélkül. Ezt a természetes serkentőt citrusfélékből nyerik ki, amelyek növelik az alapanyagcserét, amely meghatározza, hogy mennyi kalóriát éget el a test nyugalmi állapotban. Alkalmas férfiak és nők számára egyaránt.",
                "category_id" => "3",
            ],
            [
                "name" => "L-karnitin 3000 Liquid",
                "description" => "Az L-karnitin 3000 Liquid Shot egy folyékony L-karnitin forrás. Ez a 60 ml-es csomag egy gyorsan felszívódó és praktikus módja annak, hogy L-karnitint biztosíts magadnak bárhol, bármikor. Próbáld ki ezt a praktikus L-karnitin tasakot eredeti ízben.",
                "category_id" => "3",
            ],
            [
                "name" => "Night Burn",
                "description" => "A Night Burn egy éjszakai anyagcsere fokozó 5 aktív összetevő formájában. Acetil-L-karnitin, CLA, málnakivonat, 4% ketont, L-triptofán és BioPerine® fekete bors kivonat van benne. Nem tartalmaz koffeint vagy stimulánsokat, ezért nem befolyásolja az alvás minőségét vagy hosszát. Mi több, lefekvés előtt is beveheted, így segít a szervezetednek, miközben nyugodtan alszol.",
                "category_id" => "3",
            ],
            [
                "name" => "L-karnitin por 250 g",
                "description" => "Az L-karnitin por 100% L-karnitin-tartrát por formájában egyéb összetevők vagy tartósítószerek nélkül. A karnitin támogatja a szervezet anyagcseréjét, és szerepe az, hogy biztosítsa a zsírsavak mitokondriumokba történő átjutását. Mitokondriumok biztosítják az energiatermelést az emberi sejtben.",
                "category_id" => "3",
            ],
            [
                "name" => "Beast Burn anyagcsere fokozó",
                "description" => "A Beast Burn kifejezetten olyan nők számára lett kifejlesztve, akik a felesleges tömegtől hatékonyan és hosszú távon akarnak megszabadulni. Hatásos kiegészítő diéta során, de alkalmas sporttevékenységet vagy izomtömeget építő nők számára is. Mi több, energiát és vitaminokat biztosít, melyeket kiválóan hasznosíthattok vágyott fitnesz-céljaitok elérése során.",
                "category_id" => "3",
            ],
            [
                "name" => "Zsírégető Thermo Shape 2.0",
                "description" => "A Thermo Shape 2.0 egy komplex zsírégető, amely stimulálja a hőtermelést, gyorsítja az anyagcserét, tehát intenzívebben és gyorsabban segít égetni a zsírt. A Thermo Shape egy intelligens zsírégető, amelyben a gondosan kiválogatott hatóanyagok még a pihenés ideje alatt is elősegítik a kalóriaégetést.",
                "category_id" => "3",
            ],
            [
                "name" => "Appetite Control",
                "description" => "Az Appetite Control mindazoknak szól, akik hatékonyan szeretnének fogyni, és szabályozni akarják állandó éhségérzetüket, valamint az édes és sós ételek iránti sóvárgásukat. Az összetevők között szerepel például egy fehérbab-kivonat, amely bizonyított szénhidrátblokkolóként ismert. Mindemellett tartalmazza a természetes HCA zsírégetőt és krómot is, amely pozitívan befolyásolja a normál vércukorszint fenntartását.",
                "category_id" => "3",
            ],
            [
                "name" => "Hydroxycut Hardcore Elite zsírégető 110 tabl",
                "description" => "A Hydroxycut Hardcore Elite zsirégető a legújabb és nagyon erős zsírégető, amely főleg a testépítőknek ajánlott. LiquiTech speciális összetevőt tartalmaz, amely a folyadék gyors mikrodiszperzió technológiáját használja. 14 összetevőből áll, amelyek a gyors zsírégetéshez vezetnek.",
                "category_id" => "3",
            ]    */
            [
                "name" => "",
                "description" => "",
                "category_id" => "$category_id",
            ],
        ];

        //
        foreach ($products as $product) {
            //termékek feltöltése
            $newProduct = new Product();
            $newProduct->name = $product["name"];
            $newProduct->list_price = round ( rand($min=1000, $max=20000),-3 );
            $n = rand($min=1, $max=9);
            if( $n % 2 == 0){
                $newProduct->discount_price = round( ($newProduct->list_price * 0.7), -3);
            }
            $newProduct->description = $product["description"];
            $newProduct->manufacturer_id = rand($min=1, $max=9);
            $newProduct->category_id = $product["category_id"];
            $newProduct->quantity = rand($min=5, $max=50);
            $newProduct->is_online_product = 0;
            
            $newProduct->save();
            //termékekhez tartozó képek "feltöltése"
            for ($i=0; $i < 4; $i++) { 
                $newProductImage = new Product_image();
                $newProductImage->product_id = $newProduct->id;
                $newProductImage->image = "/images/products/1641560683just-whey-chocolate-milkshake-2-kg-gymbeam.jpg";
                $newProductImage->sorrend = $i + 1;
                $newProductImage->save();

            }
        }
        DB::statement("SET foreign_key_checks=1");    
    }
}
