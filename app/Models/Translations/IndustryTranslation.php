<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class IndustryTranslation extends Model
{
    protected $table = 'industries_translations';

    protected $fillable = ['name','industry_id'];
}
