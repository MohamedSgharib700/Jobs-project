<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{

    use SoftDeletes;
    protected $table = 'jobs';
    protected $fillable = ['title', 'industry_id', 'years_of_experience', 'career_level', 'career_level', 'user_id', 'active'];
    protected $with = ['industry'];


    public function roles()
    {
        return $this->belongsToMany(Industry::class, 'job_roles', 'job_id', 'role_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}

