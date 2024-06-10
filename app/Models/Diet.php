<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Diet extends Model
{
    use HasFactory;

    protected $dates = ['active_form', 'active_to', 'when'];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }

}
