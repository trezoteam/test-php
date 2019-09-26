<?php

namespace App\Http\Controllers\Question;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\question;
use App\Models\answer;
use App\Models\quiz;
use DB;
class QuestionController extends Controller
{
    private $question;
    private $quiz;
    private $answer;
    private $request;

    public function __construct(Question $question,Quiz $quiz,  Request $request, Answer $answer)
    {
        $this->answer = $answer;
        $this->question = $question;
        $this->quiz = $quiz;
        $this->request = $request;
    }
    public function index($id)

    {
        //////////monta valores ///////////
        $quiz = DB::table('quiz')
            ->select(DB::raw('count(q.id) as qtd'),'name','quiz.id','description','quiz.created_at','quiz.updated_at')
            ->leftjoin ('public.question as q', 'q.quiz_id', '=', 'quiz.id')
            ->where('quiz.id', '=', "$id")
            ->groupBy('quiz.id','name','description','quiz.created_at','quiz.updated_at')
            ->first();

        //////////retorna valores na view ///////////
        return view("cadastro.quiz", compact( 'quiz'));
    }

    public function insert()
    {
        ////////recebe as checkbox e preenche o valor ture ou false//////
        $box1 = $this->request->get('quiz_box1') ? true : false;
        $box2 = $this->request->get('quiz_box2') ? true : false;
        $box3 = $this->request->get('quiz_box3') ? true : false;
        $box4 = $this->request->get('quiz_box4') ? true : false;

        ////////monta um array com a checkbox acima//////
        $boxForm = array($box1, $box2, $box3, $box4);

        ////conta quantas checkbox esta com valor "true", se a pergunta é múltipla escolha////
        $count = 0;
        for ($i=0; $i < count($boxForm); $i++) {
            if($boxForm[$i] == true){
                $count++;
            }
        }

        //////////recebe form//////////
        $question = $this->question;
        $question->quiz_id = $this->request->get('quiz_id');
        $question->question = $this->request->get('quiz_question');
        $question->mul_choice = ($count > 1) ? 'Y' : 'N' ;
        ///// insere pergunta///////
        $save =  $this->question->save([$question]);

        //// pega o id da pergunta inserida/////////
        $lastId = $this->question->id;

        //////////recebe alternativas [array]////////
        $alt = $this->request->only(['quiz_alt']);

        ////////monta linha da alternativa e insere no banco /////////
        for ($i=0; $i < count($alt['quiz_alt']); $i++)
        {
            $answer                 = new answer();
            $answer->question_id    = $lastId;
            $answer->answer         = $alt['quiz_alt'][$i];
            $answer->is_correct     = $boxForm[$i];
            $answer->quiz_id = $this->request->get('quiz_id');
            $answer->save();
        }


        //////// Retorna na view alerta///////////
        if($save) {
            $this->request->session()->flash('alert-success', 'Dados Salvos com Sucesso!');
            return redirect("edit_quiz/".$this->request->get('quiz_id'));
        }
        else{
            $this->request->session()->flash('alert-danger', 'Ocorreu um ERRO ao salvar, tente novemente ou contate o administrador');
            return redirect("edit_quiz/".$this->request->get('quiz_id'));
        }

    }
    public function edit($id)
    {
        //////valores do quiz/////////
        $quiz = $this->quiz
            ->select('*')
            ->where('id', '=', "$id")
            ->first();

        /////retorna valores na view///////
        return view('cadastro.quiz', compact('id', 'quiz'));
    }


}
