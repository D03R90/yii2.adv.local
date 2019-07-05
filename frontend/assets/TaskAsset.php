<?php


namespace frontend\assets;


use yii\web\AssetBundle;

class TaskAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/client.js'
    ];

    public $css = [
        'css/task.css'
    ];

}