<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 4/8/2020
 * Time: 1:47 PM
 */

namespace App\Models;


class Post extends Model
{

    protected $fillable = [
        'user_id', 'title', 'description'
    ];
}