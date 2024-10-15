<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::insert([
            ['code'=>'A','name'=>'Österreich'],
            ['code'=>'D','name'=>'Deutschland'],
            ['code'=>'CH','name'=>'Schweiz'],
            ['code'=>'LUX','name'=>'Luxemburg'],
            ['code'=>'I','name'=>'Italien'],
            ['code'=>'SK','name'=>'Slowakei'],
            ['code'=>'CZ','name'=>'Tschechien'],
            ['code'=>'PL','name'=>'Polen'],
            ['code'=>'F','name'=>'Frankreich'],
            ['code'=>'SLO','name'=>'Slowenien'],
            ['code'=>'H','name'=>'Ungarn'],
            ['code'=>'B','name'=>'Belgien'],
            ['code'=>'BG','name'=>'Bulgarien'],
            ['code'=>'DK','name'=>'Dänemark'],
            ['code'=>'GB','name'=>'Großbritannien'],
            ['code'=>'HR','name'=>'Kroatien'],
            ['code'=>'IRL','name'=>'Irland'],
            ['code'=>'KW','name'=>'Kuweit'],
            ['code'=>'LT','name'=>'Litauen'],
            ['code'=>'LV','name'=>'Lettland'],
            ['code'=>'NL','name'=>'Niederlande'],
            ['code'=>'PT','name'=>'Portugal'],
            ['code'=>'RO','name'=>'Rumänien'],
            ['code'=>'RUS','name'=>'Russische Föderation'],
            ['code'=>'TR','name'=>'Türkei'],
            ['code'=>'E','name'=>'Spanien'],
            ['code'=>'SE','name'=>'Schweden'],
            ['code'=>'FL','name'=>'Finnland'],
            ['code'=>'NO','name'=>'Norwegen'],
            ['code'=>'IS','name'=>'Island'],
            ['code'=>'US','name'=>'USA'],
            ['code'=>'LIE','name'=>'Lichtenstein'],
            ['code'=>'SRB','name'=>'Serbien']
        ]);
    }
}
