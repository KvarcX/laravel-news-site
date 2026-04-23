<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public const MODERATOR = 'moderator';
    public const READER    = 'reader';

    protected $fillable = ['name', 'title'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
