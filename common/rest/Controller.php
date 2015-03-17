<?php
/**
 * Controller.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\rest;

use yii\filters\auth\CompositeAuth;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * Class Controller
 * @package common\rest
 */
abstract class Controller extends \yii\rest\Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'application/xml' => Response::FORMAT_XML,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::class,
                'actions' => $this->verbs(),
            ],

            'authenticator' => [
                'class' => CompositeAuth::class,
//                'class' => HttpBearerAuth::class,
            ],
            'rateLimiter' => [
                'class' => RateLimiter::class,
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => $this->accessRules(),
            ],
        ];
    }

    /**
     * @return array
     */
    abstract protected function accessRules();
}