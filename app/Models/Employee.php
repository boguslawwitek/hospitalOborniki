<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $hidden = ['pivot', 'created_at', 'updated_at'];
    public function contents() {
        return $this->belongsToMany(Content::class, 'content_employee', 'employee_id', 'content_id');
    }
}
