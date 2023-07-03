<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joblisting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function enhancements()
    {
        return $this->belongsToMany(Enhancement::class, 'enhancement_joblisting')
            ->withTimestamps();
    }
}
