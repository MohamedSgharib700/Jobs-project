<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use Translatable;
    use SoftDeletes;
    protected $table = 'languages';
    public $translatedAttributes = ['name'];
    protected $fillable = ['active'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_language', 'language_id', 'user_id');
    }
}
