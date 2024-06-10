<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;


    public $hidden = ['created_at'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'content_employee', 'content_id', 'employee_id');
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'content_notification', 'content_id', 'notification_id');
    }

    public function photos()
    {
        return $this->hasMany(Photos::class, 'content_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'content_id', 'id');
    }

}
