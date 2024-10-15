<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image as ImageResize;

class Image extends Model
{
    use HasFactory;

    public $table = "images";


    protected $fillable = [
        'url',
        'objekt_id',
        'projekt_id',
        'description',
        'copyright',
        'orig_path',
        'web_path',
        'thumb_path',
        'extension',
        'order'
    ];

    public function objekt(){
        return $this->belongsTo(Objekt::class);
    }

    public function projekt(){
        return $this->belongsTo(Projekt::class);
    }



    public static function addImage($imageFile, $folder, $objektId, $projektId = NULL, $description = "", $order = 0, $image = false)
    {
        if ($image == false) {
            $image = new Image();
            $image->orig_path = '';
            $image->thumb_path = '';
            $image->web_path = '';
            $image->description = $description;
            $image->order = $order;
            $image->extension = $imageFile->getClientOriginalExtension();
            $image->objekt_id = $objektId;
            $image->projekt_id = $projektId;
            $image->save();
        }

        $imgId = $image->id;
        $ext = $imageFile->extension();
        $origPath = $imageFile->storeAs($folder, $imgId . "_orig." . $ext, ['disk' => 'public']);

        $img = ImageResize::make($imageFile->path());
        $img2 = ImageResize::make($imageFile->path());
        $thumbPath = $folder . "/" . $imgId . "_thumb." . $ext;
        $webPath = $folder . "/" . $imgId . "_web." . $ext;

        $img->resize(550,550, function ($const){
            $const->aspectRatio();
        })->save(storage_path('app/public/'.$webPath), 100);

        $img2->resize(200,200, function ($const){
            $const->aspectRatio();
        })->save(storage_path('app/public/'.$thumbPath), 100);

        $image->orig_path = $origPath;
        $image->thumb_path = $thumbPath;
        $image->web_path = $webPath;
        $image->save();

    }
}
