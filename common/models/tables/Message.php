<?php

namespace common\models\tables;

use common\models\User;
use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $user_id
 *
 * @property Users $user
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['user_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'user_id' => 'User ID',
        ];
    }

   /* public function fields()
    {
        return [
            'header' => 'title',
            'test' => function(){
                return 'kdjfkjfkdgj';
            }
        ];
    }*/

    public function extraFields()
    {
        return ['user'];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
