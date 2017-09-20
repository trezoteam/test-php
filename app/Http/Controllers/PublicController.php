<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\question;
use App\Models\answer;
use App\Models\quiz;
use App\Models\result;
use App\Models\soccer;
use DB;

class PublicController extends Controller
{
    private $question;
    private $quiz;
    private $answer;
    private $request;
    private $result;
    private $soccer;

    public function __construct(Question $question,Quiz $quiz,  Request $request, Answer $answer, Result $result,Soccer $soccer)
    {
        $this->answer = $answer;
        $this->question = $question;
        $this->quiz = $quiz;
        $this->request = $request;
        $this->result = $result;
        $this->soccer = $soccer;
    }
    public function index()

    {
        ////////Monta index ///////
        $quiz = $this->quiz
            ->select('*')
            ->get();

    /////retorna valores na view/////
        return view("home", compact( 'quiz'));
    }

    public function quiz()
    {
        /////////Recebe os valores do form/////////
        $id = $this->request->get('quiz_id');
        $value = $this->soccer;
        $value->name = $this->request->get('name');
        $value->email = $this->request->get('email');
        ///////insere o jogador na base ///////////
        $value->save([$value]);

        /////////ID do jogador inserido acima ///////////
        $lastid = $this->soccer->id;

        ///// alternativas do quiz selecionado///////
        $answer = $this->answer
            ->select('id','answer', 'is_correct', 'question_id')
            ->where('quiz_id', '=', "$id")
            ->get();

        ///// questoes do quiz selecionado///////
        $question = $this->question
            ->select('question', 'id', 'mul_choice')
            ->distinct('question')
            ->where('quiz_id', '=', "$id")
            ->orderBY('question')
            ->get();

        ///// Informações do quiz selecionado///////
        $quiz = $this->quiz
            ->select('name','id','description','created_at','updated_at')
            ->where('id', '=', "$id")
            ->first();

        //////retorna na view//////
        return view('play',compact('quiz', 'question', 'answer', 'lastid'));
    }


    public  function index_user($id)
    {
        /////retorna id do quiz na view /////
        return view('account', compact('id'));
    }

    public function result()
    {
        /////recebe valores do form/////
        $quiz_id = $this->request->get('quiz_id');
        $quiz_name = $this->request->get('quiz_name');
        $sum = array();
        $alt = $this->request->only(['alt']);


        /////joga as respostas dentro de um array/////
        foreach ($alt as $alt2)
        {
            $sum = $alt2;
        }


        /////monta um select das respostas/////
        $save = $this->answer
            ->select('quiz_id','question_id','id')
            ->whereIn('id', $sum)
            ->get();


        /////percorre o retorno do banco e insere na base/////
        foreach ($save as $key => $value){
            $add           = new Result();
            $add->jogador_id = $this->request->get('soccer_id');
            $add->quiz_id = $value->quiz_id;
            $add->question_id = $value->question_id;
            $add->answer_id = $value->id;

            $add->save();

        }


        ///// conta quantas respostas 'true' o jogador respondeu////////
        $answer = $this->answer
            ->select(DB::raw('count(id) as qtd'))
            ->where('is_correct', '=', 'true')
            ->whereIn('id', $sum)
            ->get();


        ///// conta quantas respostas tem no quiz////////
       $question = $this->answer
            ->select(DB::raw('count(id) as qtd_quiz'))
            ->where('quiz_id','=', $quiz_id)
            ->where('is_correct', '=', 'true')
            ->get();



        //////// calcula a % de acerto do jogador///////////
        $value = ($answer[0]->qtd / $question[0]->qtd_quiz * 100);

        $value = number_format($value,2,",",".");

        /////////// retorna os valores na view//////////
        return view('result', compact('value', 'quiz_name'));
    }


}
