<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class LanguageTranslation extends Model
{
    protected $table = 'languages_translations';

    protected $fillable = ['name','language_id'];
}
