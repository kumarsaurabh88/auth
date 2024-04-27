<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content']; // Assuming these are your blog fields

    public function images()
    {
        return $this->hasMany(Blog::class);
    }


}