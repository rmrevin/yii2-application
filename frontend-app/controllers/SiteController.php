<?php
/**
 * SiteController.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\controllers;

use frontend\components\Controller;
use yii\captcha\CaptchaAction;
use yii\web\ErrorAction;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

/**
 * Class SiteController
 * @package frontend\controllers
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_DEBUG ? 'testme' : null,
            ],
        ];
    }

    /**
     * @return \yii\web\Response
     */
    public function actionIndex()
    {
        throw new HttpException(503, 'Under Construction');
    }

    /**
     * @return string
     */
    public function actionBootstrap()
    {
        $this->layout = '//wide';
        return $this->render('bootstrap-preview');
    }
}