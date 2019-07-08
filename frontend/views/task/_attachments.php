<?php
use yii\widgets\ActiveForm;
use yii\helpers\{Url, Html};
?>

<h3>Вложения</h3>
<?php $form = ActiveForm::begin([
    'action' => Url::to(['task/add-attachment']),
    'options' => ['class' => "form-inline"]
]); ?>
<?= $form->field($taskAttachmentForm, 'taskId')->hiddenInput(['value' => $model->id])->label(false); ?>
<?= $form->field($taskAttachmentForm, 'attachment')->fileInput(); ?>
<?= Html::submitButton("Добавить", ['class' => 'btn btn-default']); ?>
<? ActiveForm::end() ?>
<hr>
<div class="attachments-history">
    <? foreach ($model->taskAttachments as $file): ?>
        <a href="/img/tasks/<?= $file->path ?>">
            <img src="/img/tasks/small/<?= $file->path ?>" alt="">
        </a>
    <?php endforeach; ?>
</div>