<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projekt extends Model
{
    use HasFactory;

    public $table = "projekts";


    protected $fillable = [
        'construction',
        'competence',
        'projekt_type_code',
        'total_pools',
        'material',
        'depth_min',
        'depth_max',
        'length',
        'width',
        'surface',
        'sports_pool',
        'arge',
        'ppp',
        'start_month',
        'start_year',
        'end_month',
        'end_year',
        'order',
        'note',
    ];

    public static $projekt_construction_types = [
        'N' => 'Neubau',
        'S' => 'Sanierung'
    ];

    public static $projekt_competence_types = [
        'BEC' => 'Beckenbau',
        'TGU' => 'Technischer Generalunternehmer',
        'GU' => 'Generalunternehmer',
        'TOT' => 'Totalunternehmer',
    ];

    public static $projekt_material_types = [
        '1.4404' => '1.4404',
        '1.4547' => '1.4547 / 254SMO',
        '1.4462' => '1.4462',
        '' => 'Aluminium',
    ];

    public function objekt(){
        return $this->belongsTo(Objekt::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function project_type(){
        return $this->belongsTo(ProjektType::class, 'projekt_type_code', 'code');
    }
}
