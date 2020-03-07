<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployerDetails extends Model
{

    use SoftDeletes;
    protected $table = "employer_details";
    protected $fillable = ['company_name', 'industry_id', 'company_size', 'job_title', 'location_id','user_id'];

    public function location()
    {
        return $this->hasOne(Location::class,'id','location_id');
    }

    public function industry()
    {
        return $this->hasOne(Industry::class,'id','industry_id');
    }
}
