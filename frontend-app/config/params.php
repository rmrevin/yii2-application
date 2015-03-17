<?php
/**
 * params.php
 * @author Revin Roman http://phptime.ru
 */

return [
    'component.i18n' => [
        'translations' => [
            'account' => common\components\RussianMessageSource::class,
            'blank' => common\components\RussianMessageSource::class,
        ],
    ],
    'component.user' => [
        'class' => yii\web\User::class,
        'identityClass' => frontend\modules\Account\models\User::class,
        'enableAutoLogin' => true,
        'loginUrl' => ['/account/sign/in'],
    ],
];