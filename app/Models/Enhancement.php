<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enhancement extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Reverse relationship::
    // e.g. $joblistings = $enhancement->joblistings;
    public function joblistings()
    {
        return $this->belongsToMany(Joblisting::class, 'enhancement_joblisting');
    }
}
