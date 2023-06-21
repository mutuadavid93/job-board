<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public function joblisting()
    {
        return $this->hasMany(JobListing::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
