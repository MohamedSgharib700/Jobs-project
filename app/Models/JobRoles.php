<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobRoles extends Model
{

    protected $table = 'job_roles';
    protected $fillable = ['job_id', 'role_id'];
//    protected $with = ['roles'];


    public function industry()
    {
        return $this->belongsTo(Industry::class,'role_id');
    }

}

