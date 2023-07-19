<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Joblisting extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    public function enhancements()
    {
        return $this->belongsToMany(Enhancement::class, 'enhancement_joblisting')
            ->withTimestamps();
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'joblistings_index';
    }
}
