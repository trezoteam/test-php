<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['subject', 'quiz_id', 'type'];


    public function getTypeLabelAttribute() {
        if($this->type== '1')
            return 'Múltipla Escolha';
        else
            return 'Caixa de Texto';
    }

    public function answer() {
        return $this->hasMany('App\QuestionAnswer');
    }

    public function AnswerCorrect() {
        return $this->answer()->where('is_correct', true);
    }

    public function quiz() {
        return $this->belongsTo('App\Quiz');
    }

}
