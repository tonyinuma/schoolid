<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $table = 'social';
    public $timestamps = false;
    protected $guarded = ['id'];
}
