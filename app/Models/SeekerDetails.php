<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeekerDetails extends Model
{
    use SoftDeletes;

    protected $table = 'seeker_details';
    protected $fillable = ['user_id',
        'marital_status',
        'military_status',
        'social_account',
        'cv'
    ];

    public function seeker(){
        return $this->belongsTo(User::class);
    }
}
