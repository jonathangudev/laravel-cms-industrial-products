<?php

namespace App\Pages;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class HomePage extends Model implements HasMedia
{
    use HasMediaTrait;
}
