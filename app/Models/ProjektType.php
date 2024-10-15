<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjektType extends Model
{
    use HasFactory;

    public $table = "projekt_types";
    public $timestamps = false;


    protected $fillable = [
        'code',
        'name'
    ];

}
