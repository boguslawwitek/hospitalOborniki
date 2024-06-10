<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subsidies extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(SubsidiesTypes::class, 'subsides_type', 'id');
    }

    public function photos() {
        return $this->hasMany(SubsidiesPhotos::class, 'subside_id', 'id');
    }

    public function getSlug() {
        return substr(Str::slug($this->title), 0, 40);
    }
}
