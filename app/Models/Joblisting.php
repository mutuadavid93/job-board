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

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'joblisting_tag');
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
