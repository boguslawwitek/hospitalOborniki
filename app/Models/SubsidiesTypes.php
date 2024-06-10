<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsidiesTypes extends Model
{
    use HasFactory;

    public function subsides() {
        return $this->hasMany(Subsidies::class, 'subsides_type', 'id');
    }
}
