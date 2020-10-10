<?php
namespace App;

use  PictureStorage;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    #use this function anywhere in the project to view an object image
    // public static function get_image($object )
    // {
    //     return  PictureStorage::disk('s3')->response($object->image_url); 

    // }
    public static function get_image($url )
    {
        return  PictureStorage::disk('s3')->response($url); 

    }
}
