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
                        'actions' => ['auth'],
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
        $AuthResponse = new Account\models\AuthResponse;

        $attributes = $Client->getUserAttributes();
        $AuthResponse->response = Json::encode($attributes);

        $UserQuery = Account\models\User::find();

        switch ($Client->getName()) {
            case 'facebook':
                $UserQuery->byFacebookId($Client->getId());
                break;
            case 'github':
                $UserQuery->byGithubId($Client->getId());
                break;
            case 'google':
//                 @todo implement google support
                throw new \yii\base\NotSupportedException;

//                $UserQuery->byGoogleId($Client->getId());
                break;
            case 'linkedin':
//                 @todo implement linkedin support
                throw new \yii\base\NotSupportedException;

//                $UserQuery->byLinkedinId($Client->getId());
                break;
            case 'live':
//                 @todo implement live support
                throw new \yii\base\NotSupportedException;

//                $UserQuery->byLiveId($Client->getId());
                break;
            case 'twitter':
                $UserQuery->byTwitterId($Client->getId());
                break;
            case 'vkontakte':
//                @todo implement vkontakte support
                throw new \yii\base\NotSupportedException;

//                $UserQuery->byVkontakteId($Client->getId());
                break;
            case 'yandex':
//                @todo implement yandex support
                throw new \yii\base\NotSupportedException;

//                $UserQuery->byYandexId($Client->getId());
                break;
        }

        /** @var Account\models\User $User */
        $User = $UserQuery->one();

        if ($User instanceof Account\models\User) {
            $User->appendClientAttributes($Client);

            if ($User->save()) {
                $AuthResponse->result = Json::encode($User->id);
            } else {
                $AuthResponse->result = Json::encode($User->getErrors());
            }
        } else {
            $User = new Account\models\User();
            $User->appendClientAttributes($Client);

            if ($User->save()) {
                $AuthResponse->result = Json::encode($User->id);

                AuthManager()->assign(RbacFactory::Role(Account\models\User::ROLE_USER), $User->id);
            } else {
                $AuthResponse->result = Json::encode($User->getErrors());
            }
        }

        $AuthResponse->save();

        if ($User instanceof Account\models\User && !$User->isNewRecord) {
            $User->save();

            User()->login($User, 86400);
        }
    }
}