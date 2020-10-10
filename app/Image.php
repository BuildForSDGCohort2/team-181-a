<?php
namespace App;

use  PictureStorage;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    public static function get_image($object )
    {
        return  PictureStorage::disk('s3')->response($object);

    }
}
