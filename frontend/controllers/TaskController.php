<?php

namespace frontend\controllers;

use app\models\forms\TaskAttachmentsAddForm;
use common\models\tables\TaskComments;
use common\models\tables\Tasks;
use common\models\tables\TaskStatuses;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class TaskController extends Controller
{

    public function actionIndex()
    {
        $query = Tasks::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOne($id){
        return $this->render("one", [
            'model' => Tasks::findOne($id),
            'statusesList' => TaskStatuses::getList(),
            'usersList' => User::getUsersList(),
            'taskCommentForm' => new TaskComments(),
            'taskAttachmentForm' => new TaskAttachmentsAddForm(),
            'userId' => \Yii::$app->user->id,
            'channel' => 'Task_' . $id
        ]);
    }

    public function actionSave($id)
    {

        if ($model = Tasks::findOne($id)) {
            $model->load(\Yii::$app->request->post());
            $model->save();
            \Yii::$app->session->setFlash('success', "Изменеия сохранены");
        } else {
            \Yii::$app->session->setFlash('error', "Не удалось сохранить изменения");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionAddComment()
    {
        $model = new TaskComments();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            //  \Yii::$app->session->setFlash('success', "Комментарий добавлен");
            $id = $model->task_id;
            return $this->renderAjax('_comments',
                [
                    'model' => Tasks::findOne($id),
                    'taskCommentForm' => new TaskComments(),
                    'userId' => \Yii::$app->user->id,
                ]);
        }
        //  $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionAddAttachment()
    {
        $model = new TaskAttachmentsAddForm();
        $model->load(\Yii::$app->request->post());
        $model->attachment = UploadedFile::getInstance($model, 'attachment');
        if ($model->save()) {
            \Yii::$app->session->setFlash('success', "Файл добавлен");
        } else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить файл");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }
}