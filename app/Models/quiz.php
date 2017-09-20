<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{   protected $dateFormat = 'Y-m-d H:i:sO';
    protected $table = 'public.quiz';
    protected $primaryKey = 'id';
    protected $fillable =  ['name','description','created_at','updated_at'];
    public $timestamps = 'created_at';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
