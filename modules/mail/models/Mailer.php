<?php
namespace mail\models;

use mail\components\MailUrl;
use user\models\Profile;
use user\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * Login form
 */
class Mailer
{
    // keep these names, they define which classes / functions are loaded
    const BOOKING_RENTER_CONFIRMATION = 'BookingRenter.confirmation';
    const BOOKING_RENTER_DECLINE = 'BookingRenter.decline';
    const BOOKING_RENTER_RECEIPT = 'BookingRenter.receipt';
    const BOOKING_RENTER_REQUEST = 'BookingRenter.request';
    const BOOKING_RENTER_STARTS = 'BookingRenter.start';
    const BOOKING_RENTER_PAYMENT_FAILED = 'BookingRenter.failed';
    const BOOKING_OWNER_CANCELLED = 'BookingRenter.cancel';

    const BOOKING_OWNER_CONFIRMATION = 'BookingOwner.confirmation';
    const BOOKING_OWNER_PAYOUT = 'BookingOwner.payout';
    const BOOKING_OWNER_REQUEST = 'BookingOwner.request';
    const BOOKING_OWNER_STARTS = 'BookingOwner.start';
    const BOOKING_OWNER_PAYMENT_FAILED = 'BookingOwner.failed';

    const REVIEW_PUBLIC = 'Review.published';
    const REVIEW_REMINDER = 'Review.reminder';
    const REVIEW_REQUEST = 'Review.request';

    const ITEM_UNPUBLISHED_REMINDER = 'Item.unfinishedReminder';

    const MESSAGE = 'Conversation.newMessage';
    const USER_RECONFIRM = 'User.reconfirm';
    const USER_WELCOME = 'User.welcome.twig';
    const USER_RECOVERY = 'User.recovery';

    public function __construct()
    {
        $this->sender = 'info@kidup.dk';
        $this->senderName = 'KidUp';
        $this->viewPath = '@app/modules/mail/views';
        $this->registerWidgets();
    }

    public static function send($type, $data)
    {
        $mailerClassName = "mail\\mails\\" . explode('.', $type)[0];
        $mailer = new $mailerClassName();

        return $mailer->{explode('.', $type)[1]}($data);
    }

    public function sendMessage($data)
    {
        $mailer = Yii::$app->mailer;
        $mailer->viewPath = $this->viewPath;
        $mailer->getView()->theme = \Yii::$app->view->theme;
        $logId = MailLog::getUniqueId();

        $params = Json::decode(Json::encode($data['params']));
        foreach ($data['urls'] as $name => $url) {
            $params['urls'][$name] = MailUrl::to($url, $logId);
        }

        $params['receivingProfile'] = Profile::find()->where(['user_id' => User::findOne(['email' => $data['email']])->id])
            ->select('first_name')->asArray()->one();
        $params['urls']['mailInBrowser'] = MailUrl::to(Url::to('@web/mail/' . $logId, true), $logId);
        $params['urls']['changeSettings'] = MailUrl::to(Url::to('@web/user/settings/profile', true), $logId);

        if (isset($data['sender'])) {
            $this->sender = $data['sender'];
        }
        if (isset($data['sender_name'])) {
            $this->senderName = $data['senderName'] . ' (KidUp)';
        }

        $log = MailLog::create($data['type'], $data['email'], $params, $logId);

        $view = self::getView($data['type']);
        \Yii::$app->params['tmp_email_params'] = $params;
        return $mailer->compose($view, $params)
            ->setTo($data['email'])
            ->setReplyTo([$this->sender => $this->senderName])
            ->setFrom(['info@kidup.dk' => $this->senderName])
            ->setSubject($data['subject'])
            ->send();
    }

    /**
     * Register all email widgets to the global twig scope
     */
    public function registerWidgets(){
        $path = \Yii::$aliases['@mail'].'/widgets/';
        $results = scandir($path);

        $globals = [];
        $functions = [];
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;

            if (is_dir($path . '/' . $result)) {
                $globals[$result] = "mail\\widgets\\".$result."\\".ucfirst($result);
            }
        }

        $originalConfig = Yii::$app->getComponents()['view'];
        if(!isset($originalConfig['renderers']['twig']['functions'])){
            $originalConfig['renderers']['twig']['functions'] = [];
        }
        if(!isset($originalConfig['renderers']['twig']['globals'])){
            $originalConfig['renderers']['twig']['globals'] = [];
        }
        $originalConfig['renderers']['twig']['functions'] = ArrayHelper::merge($functions,
            $originalConfig['renderers']['twig']['functions']);
        $originalConfig['renderers']['twig']['globals'] = ArrayHelper::merge($globals,
            $originalConfig['renderers']['twig']['globals']);

        Yii::$app->setComponents([
            'view' => $originalConfig
        ]);
    }
}