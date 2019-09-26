<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class result extends Model
{
    protected $dateFormat = 'Y-m-d H:i:sO';
    protected $table = 'public.result';
    protected $primaryKey = 'id';
    protected $fillable =  ['jogador_id','quiz_id','answer1_id','answer2_id','answer3_id','answer3_id','dt_fim'];
    public $timestamps = 'dt_fim';

    const CREATED_AT = 'dt_fim';
    const UPDATED_AT = 'dt_fim';
}
