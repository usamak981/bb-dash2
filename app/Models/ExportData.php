<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportData extends Model
{
    use HasFactory;

    public $table = "export_data";

    public static $water_surface_operators = ['<','>','='];

    protected $fillable = [
        'name',
        'object_count',
        'project_count',
        'search',
        'start_year',
        'end_year',
        'category',
        'country_code',
        'city',
        'objekt_type_code',
        'competence',
        'projekt_type_code',
        'competition_pool',
        'water_surface_type',
        'water_surface_operator',
        'water_surface_value',
        'arge',
        'ppp',
        'created_at',
        'updated_at'
    ];



}
