<?php

namespace App\Library;

use Image;

class Images
{
    private static $image, $name;

    public static function make($image, $name, $width, $height)
    {
        if (empty($image)) {
            return;
        }

        static::$image = $image;
        static::$name = $name;

        static::$name = str_replace(' ', '_', strtolower(static::$name)) . '.' . static::$image->getClientOriginalExtension();
        
        static::$image = Image::make(static::$image->getRealPath());

        if (static::$image->width() > $width) { 
            static::$image->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        
        if (static::$image->height() > $height) {
            static::$image->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            }); 
        }

        static::$image->resizeCanvas($width, $height, 'center', false, '#ffffff');

        return new static;
    }

    public static function save($path)
    {
        static::$image->save(public_path("{$path}/") . static::$name);

        return static::$name;
    }
}
