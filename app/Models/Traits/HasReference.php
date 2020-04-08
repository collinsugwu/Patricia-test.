<?php

namespace App\Models\Traits;


trait HasReference
{

    protected static function bootHasReference()
    {
        static::created(function ($model) {
            $class = get_class();
            if ($model instanceof $class) {
                $s = explode('\\', $class);
                $clasname = array_pop($s);

                //For easy identification
                $start = substr($clasname, 0, 3);
//                $serial = dechex($model->id);
                $serial = $model->id;

                //Some randomness
                $random = random_chars(2);

                //For validation
                $checkSum = substr(md5("{$serial}{$random}"), 0, 4);

                $model->reference = strtoupper("{$start}-{$serial}-{$random}-{$checkSum}");
                $model->save();
            }
            return true;
        });
    }

    public static function findByReference($ref)
    {
        return self::where('reference', $ref)->first();
    }
}
