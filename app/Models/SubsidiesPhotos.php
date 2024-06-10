<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsidiesPhotos extends Model
{
    use HasFactory;

    public function subside() {
        return $this->belongsTo(Subsidies::class,  'subside_id', 'id');
    }
}
