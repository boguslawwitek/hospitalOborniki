<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function ward()
    {
        return $this->belongsTo(Wards::class);
    }
}
