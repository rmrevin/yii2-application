<?php
/**
 * error.php
 * @author Revin Roman http://phptime.ru
 *
 * @var yii\web\View $this
 * @var string $name
 * @var string $message
 * @var Exception $exception
 */

use frontend\controllers\SiteController;
use rmrevin\yii\fontawesome\FA;
use services\File;
use yii\helpers\Html;
use yii\web\HttpException;

/** @var SiteController $controller */
$controller = $this->context;

$controller->layout = '//wide';

$title = $label = Yii::t('app', 'Ошибка');
$label_options = [];
if ($exception instanceof HttpException) {
    $title = $label = Yii::t('app', 'Ошибка {number}', ['number' => $exception->statusCode]);
    Html::addCssClass($label_options, 'code');
}

$this->title = $title;

?>

<style>
    .row { padding-top: 10%; }

    .error-panel {
        background-color: rgba(255, 255, 255, 0.4);
        padding: 100px 50px;
        text-align: center;
    }
</style>

<div class="row">
    <div class="error-panel col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 scrollimation scale-in d2">
        <?
        echo Html::tag('h1', $label, $label_options);

        if (!empty($message)) {
            echo Html::tag('h4', nl2br(Html::encode($message)));
        }
        ?>
        <br>

        <?=
        Html::tag('h5', Yii::t('app', 'Вернуться на {главную}.', [
            'главную' => Html::a(FA::icon('home') . ' ' . Yii::t('app', 'главную'), ['/'])
        ])) ?>
    </div>
</div>