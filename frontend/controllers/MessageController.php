<?php


namespace frontend\controllers;


use common\models\tables\Message;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

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
        return parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $query = Message::find();

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }
}