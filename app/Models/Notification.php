<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $dates = ['start_at', 'end_at'];

    public $hidden = ['pivot', 'created_at', 'updated_at'];
    public function content()
    {
        return $this->belongsToMany(Content::class, 'content_notification', 'notification_id', 'content_id');
    }
}
