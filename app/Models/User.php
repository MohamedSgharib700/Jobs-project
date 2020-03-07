<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne as HasOneAlias;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\UserCreatedEvent;
use App\Events\UserDeletedEvent;
use App\Events\UserEditedEvent;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Passport;
use Laravel\Passport\Token;
use Laravel\Passport\TokenRepository;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'first_name', 'last_name', 'email', 'password', 'phone', 'residence_city', 'country_key', 'nationality_id', 'type',
        'job_title', 'image', 'gender', 'age', 'active', 'email_verified_at', 'token'

    ];


    protected $hidden = [
        'password',
        'remember_token',
        'token'
    ];

    /**
     * @param $pass
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $dispatchesEvents = [
        'updated' => UserEditedEvent::class,
        'deleted' => UserDeletedEvent::class,
        'created' => UserCreatedEvent::class,
    ];

//    public function setPasswordAttribute($value)
//    {
//        $this->attributes['password'] = bcrypt($value);
//    }

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = \Hash::make($pass);
    }


    public function getFullNameAttribute($value)
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }


    public function industries()
    {
        return $this->belongsToMany(Industry::class, 'users_industries', 'user_id', 'industry_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Industry::class, 'users_roles', 'user_id', 'role_id');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'user_language', 'user_id', 'language_id');
    }

    public function workingCountries()
    {
        return $this->belongsToMany(Location::class, 'seeker_working_countries', 'user_id', 'country_id');
    }

    public function details()
    {
        return $this->hasOne(SeekerDetails::class);
    }

    public function experiences()
    {
        return $this->hasOne(SeekerExperience::class);
    }


    public function nationality()

    {
        return $this->hasOne(Location::class, 'id', 'nationality_id');
    }


    public function residence()
    {
        return $this->belongsTo(Location::class, 'id', 'country_key');
    }


    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'users_skills', 'user_id', 'skill_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'user_id');
    }

    public function employerDetails()
    {
        return $this->hasOne(EmployerDetails::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'user_groups', 'user_id', 'group_id');
    }


    /**
     * @param array|string $permission
     * @return bool
     */
    public function hasAccess($permission): bool
    {
        $userPermissions = $this->permissions();

        return in_array($permission, $userPermissions);
    }

    /**
     * @return array
     */
    public function permissions(): array
    {
        $permissions = $this->query()
            ->join("user_groups", "users.id", "=", "user_groups.user_id")
            ->join("groups", "user_groups.group_id", "=", "groups.id")
            ->join("group_permissions", "groups.id", "=", "group_permissions.group_id")
            ->join("permissions", "group_permissions.permission_id", "=", "permissions.id")
            ->select("permissions.identifier")
            ->where("users.id", "=", auth()->id())
            ->distinct()
            ->get();

        $permissionsIdentifier = [];
        foreach ($permissions as $permission) {
            $permissionsIdentifier[] = $permission["identifier"];
        }

        return $permissionsIdentifier;
    }

    public function isTypeOf($userType)
    {
        return ($this->type == $userType);
    }

}
