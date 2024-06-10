<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    use HasFactory;

    public $hidden = ['pivot', 'created_at', 'updated_at'];
    private array $dimensions;

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function ward()
    {
        return $this->belongsTo(Wards::class);
    }

    public function width()
    {
        if (empty($this->dimensions)) {
            $this->getDimensions();
        }

        return $this->dimensions['width'];
    }

    public function height()
    {
        if (empty($this->dimensions)) {
            $this->getDimensions();
        }
        return $this->dimensions['height'];
    }

    private function getDimensions()
    {
        $path = $this->path;
        $this->dimensions = cache()->remember('photos.' . $this->id . '.sizes', 36000000, function () use ($path) {
            $dimensions = getimagesize(public_path('storage/' . $path));
            return [
                'width' => $dimensions[0],
                'height' => $dimensions[1]
            ];
        });
    }
}
