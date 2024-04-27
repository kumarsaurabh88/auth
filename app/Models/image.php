<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    use HasFactory;
    protected $fillable = ['blog_id', 'image_path']; // Assuming you store the path to the image

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}


