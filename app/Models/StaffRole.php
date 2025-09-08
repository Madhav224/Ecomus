<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Contracts\Role as RoleContract;
use Spatie\Permission\Traits\HasPermissions;

class StaffRole extends Model
{
    use HasFactory, HasPermissions;
    use HasPermissions;

    protected $guarded = [];

    // Relationship to Spatie's Role
    public function spatieRole()
    {
        return $this->belongsTo(RoleContract::class, 'role_id');
    }
    public function administrators()
    {
        return $this->hasMany(Administrator::class, 'staff_role_id');
    }
}
