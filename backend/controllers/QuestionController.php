<?php

namespace backend\controllers;

use backend\models\AnswerSearch;
use Yii;
use backend\models\Question;
use backend\models\QuestionSearch;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
{
    /**
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Question model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $answerSearchModel = new AnswerSearch();
        $answerDataProvider = $answerSearchModel->search(Yii::$app->request->queryParams, $id);

        return $this->render('view', [
            'model' => $model,
            'answerSearchModel' => $answerSearchModel,
            'answerDataProvider' => $answerDataProvider
        ]);
    }


    /**
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Question();
        $model->quiz_id = Yii::$app->request->get('quiz_id');

        if ($model->load(Yii::$app->request->post()) && $model->saveQuestion($model)) {
            return $this->redirect(['quiz/view', 'id' => $model->quiz_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Question model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate(['subject', 'type']) &&
            $model->updateQuestion($model)) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Question model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $quiz_id = $model->quiz_id;
        if(!$model->deleteQuestion($model))
            throw new HttpException(422, 'Não foi possível excluir este registro');

        return $this->redirect(['quiz/view', 'id' => $quiz_id]);
    }

    /**
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
