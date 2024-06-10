<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    use HasFactory;

    public function section() {
        return $this->belongsTo(TelephoneSection::class, 'telephone_section_id', 'id');
    }
}
