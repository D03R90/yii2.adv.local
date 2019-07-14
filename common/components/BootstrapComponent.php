<?php
namespace common\components;


use common\models\tables\Project;
use common\models\tables\TelegramSubscribe;
use yii\base\Component;
use yii\base\Event;

class BootstrapComponent extends Component
{

    public function init()
    {
        Event::on(Project::class, Project::EVENT_AFTER_INSERT, function(Event $event){
            $title = $event->sender->title;
            $message = "Создан новый проект {$title}";
            $chats = TelegramSubscribe::find()
                ->select('chat_id')
                ->where(['channel' => TelegramSubscribe::CHANNEL_PROJECT_CREATE])
                ->column();

            foreach ($chats as $chat){
                /** @var \SonkoDmitry\Yii\TelegramBot\Component $bot */
                $bot = \Yii::$app->bot;
                $bot->sendMessage($chat, $message);
            }
        });
    }

}