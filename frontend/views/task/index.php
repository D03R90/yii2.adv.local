<?php
/** @var \yii\data\ActiveDataProvider $dataProvider */

echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => function($model){
        return \frontend\widgets\TaskPreview::widget(['model' => $model]);
    },
    'summary' => false,
    'options' => [
        'class' => 'preview-container'
    ]
])

?>