<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class soccer extends Model
{
    protected $dateFormat = 'Y-m-d H:i:sO';
    protected $table = 'public.jogador';
    protected $primaryKey = 'id';
    protected $fillable =  ['name','email','dt_ini'];
    public $timestamps = 'dt_ini';

    const CREATED_AT = 'dt_ini';
    const UPDATED_AT = 'dt_ini';
}
