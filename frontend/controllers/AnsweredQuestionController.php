<?php

namespace frontend\controllers;

use frontend\models\AnsweredQuiz;
use frontend\models\Question;
use Yii;
use frontend\models\AnsweredQuestion;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnsweredQuestionController implements the CRUD actions for AnsweredQuestion model.
 */
class AnsweredQuestionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AnsweredQuestion models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays a single AnsweredQuestion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AnsweredQuestion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($web_user_id)
    {
        $answered_quiz = AnsweredQuiz::getLastByWebUserId($web_user_id);
        $questions = Question::findAllByQuizId($answered_quiz->quiz_id);
        $count = count($questions);
        $models = [];
        for($i = 1; $i <= $count; $i++) {
            $models[] = new AnsweredQuestion();
        }

        if (Model::loadMultiple($models, Yii::$app->request->post())) {
            foreach ($models as $model) {
                $model->save(false);
            }
            $answered_quiz->finish_at = date('Y-m-d H:i:s');
            $answered_quiz->save();
            return $this->redirect('index');

        } else {


            return $this->render('create', [
                'models' => $models,
                'questions' => $questions,
                'answered_quiz' => $answered_quiz,
            ]);
        }
    }

    /**
     * Updates an existing AnsweredQuestion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AnsweredQuestion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnsweredQuestion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnsweredQuestion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnsweredQuestion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
