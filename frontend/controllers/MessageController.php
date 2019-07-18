<?php


namespace frontend\modules\v1\controllers;


use common\models\tables\Message;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\rest\Controller;

class MessageController extends ActiveController
{
    public $modelClass = Message::class;

    public function behaviors()
    {
        $behavers = parent::behaviors();
        $behavers['authentificator'] = [

          'class' => HttpBasicAuth::class,
          'auth' => function($username, $password){
            $user = User::findByUsername($username);
            if($user !== null && $user->validatePassword($password)){
                return $user;
            }
            return null;
          }
        ];
        return $behavers;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $filter = \Yii::$app->request->get('filter');
        $query = Message::find();

        if(isset($filter['user_id'])){
            $query->where(['user_id' => $filter['user_id']]);
        }

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }
}