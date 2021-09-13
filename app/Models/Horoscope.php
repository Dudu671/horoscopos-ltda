<?php

namespace App\Models;

use App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horoscope extends Model {
    protected $fillable = [
        'title',
        'content',
        'author_id',
        'image_path'
    ];

    public function likes() {
        return $this->hasMany(Like::class);
    }
}
