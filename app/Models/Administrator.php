<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Administrator extends Authenticatable
{
    use HasFactory, HasRoles, SoftDeletes;

    protected $guarded = [];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */

    protected $hidden = ['password'];

    # Accessor for getting the parent name
    public function getUserParentAttribute()
    {
        # Use the 'parent_id' to find the parent user
        $parent = $this->parent()->first();
        # Return the parent name if found, otherwise return null
        return $parent ? $parent : null;
    }
    /**
     * A user has many referrals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany(Administrator::class, 'referrer_id', 'id');
    }

    public function staffrole()
    {
        return $this->belongsTo(StaffRole::class, 'staff_role_id');
    }

    public function parent()
    {
        return $this->belongsTo(Administrator::class, 'parent_id');
    }

    public function isAdmin()
    {
        return $this->hasRole('supperadmin');
    }

    public function isLastMaster()
    {
        $isLastMaster = Administrator::role('supperadmin')
            ->whereIn('id', [$this->parent_id, $this->id])
            ->exists();
        return !$isLastMaster;
    }

}
