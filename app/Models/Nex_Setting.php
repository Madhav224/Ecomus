<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nex_Setting extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'nex_settings';

    protected $guarded = [];

    use HasFactory;

}
