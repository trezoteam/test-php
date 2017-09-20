<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class answer extends Model
{   protected $dateFormat = 'Y-m-d H:i:sO';
    protected $table = 'public.answer';
    protected $primaryKey = 'id';
    protected $fillable =  ['question_id','answer','is_correct','created_at','updated_at'];
    public $timestamps = 'created_at';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
