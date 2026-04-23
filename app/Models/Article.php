<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'excerpt',
        'body',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->approved()->latest();
    }
}
