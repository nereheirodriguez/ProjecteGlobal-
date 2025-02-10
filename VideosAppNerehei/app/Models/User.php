<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @use HasFactory<UserFactory>
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * @var list<string>
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var list<string>
     */
    protected $appends = ['profile_photo_url'];

    public function getProfilePhotoUrlAttribute()
    {
        // Define the logic to get the profile photo URL
        return 'https://example.com/profile_photos/' . $this->id . '.jpg';
    }

    /**
     * Get the tests performed by the user.
     */
    public function testedBy()
    {
        return $this->hasMany(Test::class, 'tested_by');
    }

    /**
     * Check if the user is a super admin.
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->super_admin;
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user', 'user_id', 'team_id');
    }

    public function ownedTeams()
    {
        return $this->hasMany(Team::class, 'user_id');
    }
}
