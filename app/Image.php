<?php
namespace App;

use  PictureStorage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{

    public static function get_image($object )
    {
        return  Storage::disk('s3')->url($object->image_url);
        // dd($image);
        // return  PictureStorage::disk('s3')->response($object->image_url);
    }
}
