<?php
/**
 * params.php
 * @author Revin Roman http://phptime.ru
 */

return [
    'component.i18n' => [
        'translations' => [
            'catalog' => common\components\RussianMessageSource::class,
            'account' => common\components\RussianMessageSource::class,
            'landing' => common\components\RussianMessageSource::class,
            'portfolio' => common\components\RussianMessageSource::class,
            'like' => common\components\RussianMessageSource::class,
            'service-activity' => common\components\RussianMessageSource::class,
            'service-file' => common\components\RussianMessageSource::class,
        ],
    ],
    'component.user' => [
        'class' => yii\web\User::class,
//        'identityClass' => frontend\models\User::class,
        'enableAutoLogin' => true,
        'loginUrl' => ['/account/sign/in'],
    ],
];