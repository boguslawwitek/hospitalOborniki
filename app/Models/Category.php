<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $hidden = ['created_at', 'updated_at'];

    public function content() {
        return $this->hasMany(Content::class, 'category_id', 'id');
    }

    public function ward() {
        return $this->hasMany(Wards::class, 'category_id', 'id');
    }

    public function additionalLinks() {
        return $this->hasMany(StaticMenuLinks::class, 'category_id', 'id');
    }
}
