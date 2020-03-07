<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeekerExperience extends Model
{
    use SoftDeletes;

    protected $table = 'seeker_experiences';
    protected $fillable = ['user_id',
        'years_of_experience',
        'education_level',
        'previous_experience',
        'previous_experience_from_date',
        'previous_experience_to_date',
        'career_level'
    ];
}
