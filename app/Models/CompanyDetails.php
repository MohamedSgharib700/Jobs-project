<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyDetails extends Model
{
    use SoftDeletes ;

    protected $table = "company_details";

    protected $fillable = ['job_name', 'company_name', 'company_field','company_siz','location_id'];
}
