<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{   protected $dateFormat = 'Y-m-d H:i:sO';
    protected $table = 'public.question';
    protected $primaryKey = 'id';
    protected $fillable =  ['quiz_id','question','mul_choice','created_at','updated_at'];
    public $timestamps = 'created_at';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
