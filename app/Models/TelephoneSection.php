<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelephoneSection extends Model
{
    use HasFactory;

    public function phones() {
        return $this->hasMany(Telephone::class, 'telephone_section_id', 'id');
    }
}
