<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module_fields extends Model
{
    use HasFactory;

    protected $table = 'module_fields';

    protected $guarded = [];

    // Relation Module
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

}
