<?php

namespace Database\Seeders;

use App\Models\ProjektType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjektTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjektType::insert([
            ['code'=>'AB','name'=>'Ausgleichsbehälter'],
            ['code'=>'AUB','name'=>'Außenbecken'],
            ['code'=>'BRR','name'=>'Breitrutsche'],
            ['code'=>'BWB','name'=>'Bewegungsbecken'],
            ['code'=>'DSB','name'=>'Durchschreitebecken'],
            ['code'=>'DTB','name'=>'Dachterrassenbecken'],
            ['code'=>'ERB','name'=>'Erlebnisbecken'],
            ['code'=>'GWR','name'=>'Grosswasserrutsche'],
            ['code'=>'GTHB','name'=>'Glastherapiebecken'],
            ['code'=>'KIR','name'=>'Kinderrutsche'],
            ['code'=>'KPB','name'=>'Kinderplanschbecken'],
            ['code'=>'LSB','name'=>'Lehrschwimmbecken'],
            ['code'=>'LWW','name'=>'Luft-Wasser-Wärmepumpe'],
            ['code'=>'MWB','name'=>'Mineralwasserbecken'],
            ['code'=>'MZB','name'=>'Mehrzweckbecken'],
            ['code'=>'NSB','name'=>'Nichtschwimmerbecken'],
            ['code'=>'PFB','name'=>'Privatfreibecken'],
            ['code'=>'PHB','name'=>'Privathallenbecken'],
            ['code'=>'ROR','name'=>'Röhrenrutsche'],
            ['code'=>'RZB','name'=>'Rutschzielbecken'],
            ['code'=>'SAB','name'=>'Sauna-Aussenbecken'],
            ['code'=>'SOB','name'=>'Sonderbecken'],
            ['code'=>'SOL','name'=>'Solaranlage'],
            ['code'=>'SPR','name'=>'Sprunganlage'],
            ['code'=>'SWB','name'=>'Schwimmerbecken'],
            ['code'=>'TAB','name'=>'Tauchbecken'],
            ['code'=>'THB','name'=>'Therapiebecken'],
            ['code'=>'WAB','name'=>'Wasseraufbereitungsanlage'],
            ['code'=>'WEB','name'=>'Wellenbecken'],
            ['code'=>'WHP','name'=>'Whirlpool'],
            ['code'=>'WWW','name'=>'Wasser-Wasser-Wärmepumpe'],
            ['code'=>'HOT FB','name'=>'Hotel Freibecken'],
            ['code'=>'HOT HB','name'=>'Hotel Hallenbecken'],
            ['code'=>'HOT HFB','name'=>'Hotel Hallen-Freibecken'],
            ['code'=>'HOT WHP','name'=>'Hotel Whirlpool'],
            ['code'=>'HOT S','name'=>'Hotel Sauna'],
            ['code'=>'WSB','name'=>'Warmsprudelbecken'],
            ['code'=>'ASB','name'=>'Ausschimmbecken'],
            ['code'=>'HBB','name'=>'Hubbodenbecken'],
            ['code'=>'KNB','name'=>'Kneippbecken'],
            ['code'=>'ZRB','name'=>'Zierbecken'],
            ['code'=>'RU','name'=>'Rutschenanlage']
        ]);
    }
}
