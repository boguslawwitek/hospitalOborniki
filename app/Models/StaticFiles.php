<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticFiles extends Model
{
    use HasFactory;

    public static function getFilePathByKey(string $key) {
        return StaticFiles::where('key', $key)->first()->file;
    }
}
