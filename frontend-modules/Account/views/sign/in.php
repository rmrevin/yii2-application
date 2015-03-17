<?php
/**
 * in.php
 * @author Revin Roman http://phptime.ru
 */

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

?>

<style>
    .login-panel { }
</style>

<div layout="column" layout-align="center center" style="height: 100%">
    <div class="login-panel">
        <?
        $authAuthChoice = yii\authclient\widgets\AuthChoice::begin([
            'baseAuthUrl' => ['/account/sign/auth'],
            'popupMode' => false,
            'autoRender' => false,
        ]);
        echo Html::tag('label', \Yii::t('account', 'Войти через'));
        echo Html::beginTag('ul', ['class' => 'auth-clients']);
        foreach ($authAuthChoice->getClients() as $client) {
            $icon = $client->getName();
            if ($icon === 'vkontakte') {
                $icon = 'vk';
            }

            echo Html::beginTag('li');
            $authAuthChoice->clientLink($client, FA::icon($icon));
            echo Html::endTag('li');
        }
        echo Html::endTag('ul');
        yii\authclient\widgets\AuthChoice::end();
        ?>
    </div>
</div>
