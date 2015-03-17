<?php
/**
 * SignController.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\modules\Account\controllers;

use frontend\modules\Account;
use rmrevin\yii\rbac\RbacFactory;
use yii\helpers\Json;

/**
 * Class SignController
 * @package frontend\modules\Account\controllers
 */
class SignController extends Account\components\Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['in', 'auth'],
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['out'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'auth' => [
                'class' => \yii\authclient\AuthAction::class,
                'successCallback' => [$this, 'authSuccessCallback'],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIn()
    {
        if (!User()->isGuest) {
            return $this->redirect(['/order/list/index']);
        }

        $this->layout = '//wide';

        return $this->render('in');
    }

    /**
     * @return \yii\web\Response
     */
    public function actionOut()
    {
        User()->logout();

        return $this->goHome();
    }

    /**
     * @param \yii\authclient\ClientInterface $Client
     * @throws \yii\base\NotSupportedException
     */
    public function authSuccessCallback(\yii\authclient\ClientInterface $Client)
    {
        $AuthResponse = new \resources\User\Auth\Response;
        $AuthResponse->client = $Client->getId();

        $attributes = $Client->getUserAttributes();
        $AuthResponse->response = Json::encode($attributes);

        $UserQuery = \resources\User::find();

        switch ($Client->getId()) {
            case 'facebook':
                $UserQuery->byFacebookId($attributes['id']);
                break;
            case 'github':
                $UserQuery->byGithubId($attributes['id']);
                break;
            case 'google':
                $UserQuery->byGoogleId($attributes['id']);
                break;
            case 'linkedin':
                $UserQuery->byLinkedinId($attributes['id']);
                break;
            case 'live':
                $UserQuery->byLiveId($attributes['id']);
                break;
            case 'twitter':
                $UserQuery->byTwitterId($attributes['id']);
                break;
            case 'vkontakte':
                $UserQuery->byVkontakteId($attributes['id']);
                break;
            case 'yandex':
                $UserQuery->byYandexId($attributes['id']);
                break;
        }

        /** @var \resources\User $User */
        $User = $UserQuery->one();

        if ($User instanceof \resources\User) {
            $User->appendClientAttributes($Client);

            if ($User->save()) {
                $AuthResponse->result = Json::encode($User->id);
            } else {
                $AuthResponse->result = Json::encode($User->getErrors());
            }
        } else {
            $User = new \resources\User();
            $User->appendClientAttributes($Client);

            if ($User->save()) {
                $User->createSocialLink($Client);

                $AuthResponse->result = Json::encode($User->id);

                AuthManager()->assign(RbacFactory::Role(\resources\User::ROLE_USER), $User->id);
            } else {
                $AuthResponse->result = Json::encode($User->getErrors());
            }
        }

        $AuthResponse->save();

        if ($User instanceof \resources\User && !$User->isNewRecord) {
            $User->save();

            User()->login($User, 86400);
        }
    }
}