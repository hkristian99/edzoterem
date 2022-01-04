<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Post, Post_tag tábla feltöltése VALÓDI adatokkal

        //VÁLTOZÓK
            $titles = array(
                            "Fitness recept: csokibevonatos kókuszgolyók", 
                            "Fitness recept: fehérjés pizzás csigák sonkával és kukoricával",
                            "Fitness recept: raw datolyaszelet mogyoróvajjal", 
                            "Fitness recept: forró alkoholmentes karácsonyi puncs friss gyümölcsökkel", 
                            "Fitness recept: alkoholmentes karácsonyi tojáslikőr",
                            "Fitness recept: Pad Thai tészta tempeh-vel és friss zöldségekkel", 
                            "Fitness recept: quinoa pirított tofuval, zöldségekkel és avokádóval", 
                            "Lionel Messi: a fiú, aki Maradona szerint átvette a helyét az Argentin futballban", 
                            "Fitness recept: csokoládés hummusz friss gyümölccsel és sós pereccel", 
                            "Michael Phelps: a sportoló, aki megváltoztatta az úszás világát. Mi áll a sikere mögött?",
                            "Mentális egyensúly, fogyás és jobb alvás. Milyen előnyei vannak még a kirándulásnak?", 
                            "A 10 lehető legrosszabb módja az újévi fogadalmak megkezdésének", 
                            "Fitness recept: sós spenótos gofri füstölt lazaccal", 
                            "10 táplálkozási és edzési tipp a maximális izomnövekedéshez" 
                        );
            $slugs = array();
            foreach($titles as $title) {
                $slugs[] = Str::slug($title);
            }
            $leads = array(
                            "Készíts egy gyors, tökéletes kókuszgolyó desszertet a kedvenc szuperélelmiszereidből és mogyoróvajból. Ez a könnyen elkészíthető recept gazdag ízű, és rengeteg jótékony tápanyagot tartalmaz.", 
                            "Itt a sonkás-kukoricás pizzás csigák receptje, hogy mindegyikőtüknek örömet szerezzen! Kivételes ízű, nagyszerű tápértékkel rendelkezik és könnyen elkészíthető. Ráadásul igazán egyszerű, finom és egészséges.",
                            "Készítsd el a mogyoróvajas és ropogós müzlivel dúsított datolyaszeletet, amely egy gyors, finom és táplálékdús snack.", 
                            "Élvezd a szeretteiddel töltött pillanatokat egy csésze finom gyümölcsös puncs társaságában az ünnepek alatt. Megmelenget, mosolyt csal az arcodra, ráadásul mindenki számára alkalmas, hiszen nem tartalmaz alkoholt!", 
                            "Lassíts le és élvezd az ünnepeket szeretteiddel ezzel a tökéletes, fehérjével teli, alkoholmentes tojáslikőrrel. Élvezd a vaníliás finomságot ellenállhatatlan fahéjas aromával.",
                            "Próbáld ki az ízletes vegán Pad Thai receptjét tele friss zöldségekkel és tempehvel. Ez az egzotikus, zamatos finomság ízben és fehérjében gazdag.", 
                            "Ha egészséges és tápláló, pár perc alatt elkészíthető ételre vágysz, akkor jó helyen jársz! Próbáld ki a quinoa receptjét pirított tofuval, zöldségekkel és avokádóval. Nemcsak ízletes, de könnyen elkészíthető is.", 
                            "Ki minden idők legjobb futballistája? Nem más, mint a legendás Lionel Messi, aki gyerekkori problémái ellenére is eljutott a futball mennyországba.", 
                            "Kényeztesd a vendégeidet ízletes és egészséges csokoládés hummusszal, frissítő gyümölccsel és sós pereccel. Egy gyors nassolnivaló, amit biztosan dicsérni fognak!", 
                            "Ismerkedj meg a világ legsikeresebb olimpikonjának hihetetlen történetével. Összesen 28 olimpiai érmet szerzett, ebből 23 aranyérmet, 3 ezüstöt és 2 bronzot. Mit kellett tennie, hogy a legjobb legyen?",
                            "A szabadtéri tevékenységeknek köszönhetően az extra kilóktól és a negatív gondolatoktól is megszabadulhatsz. De sok más ok van még a túrázásra.", 
                            "Mik a leggyakrabban előforduló újévi fogadalmak és hogyan teljesítsük ezeket sikeresen?", 
                            "Próbáld ki ezt a csodálatos, tápláló spenótos gofri receptet füstölt lazaccal és friss zöldségekkel tálalva. Élvezd ezt a gyors és egészséges ételt a nap folyamán bármikor!", 
                            "Hogyan lehet gyorsan izmosodni? Tekintsd meg a hatékony tippjeinket, amelyek segítenek maximalizálni az erőfeszítéseid az izmos alak megszerzésére.",
                        );
            $body = "a";
            $user_id = 2;
            $post_status_id = 2;
            $cover = "/images/posts/$n.jpg";

        //DB FELTÖLTÉSE 
        //POST TÁBLA
        foreach($titles as $titles) {
            $newItem = new Post();
            $newItem->title = $titles->title;
            $newItem->slug = Str::slug($request->title);
            $newItem->lead = $lead;
            $newItem->body = $body;
            $newItem->user_id = Auth::user()->id;
            $newItem->post_status_id = 1;
            $newItem->cover = $imageName;
        }
        //POST_TAG TÁBLA
        foreach($roles as $item) {
            $newItem = new Role();
            $newItem->name = $item;
            $newItem->save();
        }
    }
}
