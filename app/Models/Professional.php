<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Professional extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'professionals';
    protected $guarded = ['id'];
    public $timestamps = false;

    protected $fillable = ['name', 'document', 'matricula', 'number_phone'];
}
