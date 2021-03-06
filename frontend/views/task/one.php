<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Url;
use \yii\helpers\Html;

/** @var  $taskCommentForm */
/** @var \app\models\forms\TaskAttachmentsAddForm $taskAttachmentForm */
/** @var \yii\web\View $this */
\frontend\assets\TaskAsset::register($this);
?>
<div class="task-edit">
    <div class="task-main">
        <?php $form = ActiveForm::begin(['action' => Url::to(['task/save', 'id' => $model->id])]);?>
        <?=$form->field($model, 'name')->textInput();?>
        <div class="row">
            <div class="col-lg-4">
                <?=$form->field($model, 'status_id')
                    ->dropDownList($statusesList)

                ?>
            </div>
            <div class="col-lg-4">
                <?=$form->field($model, 'responsible_id')
                    ->dropDownList($usersList)
                ?>
            </div>
            <div class="col-lg-4">
                <?=$form->field($model, 'deadline')
                    ->textInput(['type' => 'date'])
                ?>
            </div>
        </div>

        <div>
            <?=$form->field($model, 'description')
                ->textarea()?>
        </div>
        <?=Html::submitButton("Сохранить",['class' => 'btn btn-success']);?>
        <?ActiveForm::end()?>

   </div>
</div>
<div class="attachments">
    <?= $this->render('_attachments',
        [
            'model' => $model,
            'taskAttachmentForm' => $taskAttachmentForm
        ])
    ?>
<!--    <h3>Вложения</h3>-->
<!--    --><?php //$form = ActiveForm::begin([
//        'action' => Url::to(['task/add-attachment']),
//        'options' => ['class' => "form-inline"]
//    ]);?>
<!--    --><?//=$form->field($taskAttachmentForm, 'taskId')->hiddenInput(['value' => $model->id])->label(false);?>
<!--    --><?//=$form->field($taskAttachmentForm, 'attachment')->fileInput();?>
<!--    --><?//=Html::submitButton("Добавить",['class' => 'btn btn-default']);?>
<!--    --><?//ActiveForm::end()?>
<!--    <hr>-->
<!--    <div class="attachments-history">-->
<!--        --><?//foreach ($model->taskAttachments as $file): ?>
<!--            <a href="/img/tasks/--><?//=$file->path?><!--">-->
<!--                <img src="/img/tasks/small/--><?//=$file->path?><!--" alt="">-->
<!--            </a>-->
<!--        --><?php //endforeach;?>
    </div>

    <?= $this->render('_comments', [
        'model' => $model,
        'taskCommentForm' => $taskCommentForm,
        'userId' => $userId
    ]); ?>

<!--    --><?php
//        \yii\widgets\Pjax::begin(['enablePushState' => false]);
//    ?>
<!--    <h3>Комментарии</h3>-->
<!--    --><?php
//    $form = ActiveForm::begin([
//            'action' => Url::to(['task/add-comment']),
//            'options' => ['date-pjax' => true]
//        ]); ?>
<!--    --><?//=$form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false);?>
<!--    --><?//=$form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])->label(false);?>
<!--    --><?//=$form->field($taskCommentForm, 'content')->textInput();?>
<!--    --><?//=Html::submitButton("Добавить",['class' => 'btn btn-default']);?>
<!--    --><?//ActiveForm::end()?>
<!--    <hr>-->
<!--    <div class="comment-history">-->
<!--        --><?//foreach ($model->taskComments as $comment): ?>
<!--            <p><strong>--><?//=$comment->user->username?><!--</strong>: --><?//=$comment->content?><!--</p>-->
<!--        --><?php //endforeach;?>
<!--    </div>-->
<!--    --><?php
//    \yii\widgets\Pjax::end()
//    ?>

    <hr>

    <div class="task-chat">
        <form action="#" name="chat_form" id="chat_form">
            <label>
                <input type="hidden" name="channel" value="<?=$channel?>"/>
                <input type="hidden" name="user_id" value="<?=$userId?>"/>
                введите сообщение
                <input type="text" name="message"/>
                <input type="submit"/>
            </label>
        </form>
        <hr>
        <div id="root_chat"></div>
    </div>
</div>
<script>
    var channel = '<?=$channel?>';
</script>