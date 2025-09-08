<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'module';
    protected $guarded = [];

    // Relation  ModuleFields
    public function fields()
    {
        return $this->hasMany(Module_fields::class);
    }
}
