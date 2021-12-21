<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB FELTÖLTÉSE BASIC ADATOKKAL
        //TAG TÁBLA

        Tag::truncate();

        $handle = fopen(base_path()."/database/seeders/tags.txt", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $newItem = new Tag();
                $newItem->name = $line;
                $newItem->slug=Str::slug($newItem->name);
                $newItem->save();
            }
            fclose($handle);
        }
    }
}
