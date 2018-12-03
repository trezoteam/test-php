<?php

namespace backend\controllers;

use backend\models\Quiz;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Site controller
 */
class RestController extends ActiveController
{
    public $modelClass = 'backend\models\Quiz';

    public function behaviors(){
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'authenticator' => [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    HttpBearerAuth::className(),
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'create' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['delete']);
        unset($actions['update']);
        return $actions;
    }

    public function actionCreate()
    {
        $model = new Quiz();
        $post = \Yii::$app->request->post();
        $model->name = $post['name'];
        $model->description = $post['description'];
        $model->created_at = date('Y-m-d H:i:s');
        $model->updated_at = date('Y-m-d H:i:s');

        if($model->save()){
            return $model;
        } else {
            throw new HttpException('422', 'Não foi possível salvar os dados');
        }
    }
}
