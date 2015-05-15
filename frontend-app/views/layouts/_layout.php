<?php
/**
 * _layout.php
 * @author Revin Roman http://phptime.ru
 *
 * @var yii\web\View $this
 * @var string $content
 */

use yii\helpers\Html;

frontend\_assets\AppAsset::register($this);

$title = empty($this->title)
    ? APP_NAME
    : Html::encode($this->title) . ' ~ ' . APP_NAME;

/** @var \frontend\components\Controller $controller */
$controller = $this->context;

/** @var \resources\User|null $User */
$User = User()->identity;

$this->beginPage();

?><!DOCTYPE html>
<?= Html::beginTag('html', [
    'lang' => Yii::$app->language,
    'ng-app' => 'LandingxApp',
]) ?>
<head>
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?
    echo Html::csrfMetaTags();
    echo Html::tag('title', $title);

    echo Html::tag('meta', '', ['charset' => Yii::$app->charset]);

    if (!User()->isGuest) {
        echo Html::tag('meta', null, ['name' => 'token', 'content' => $User->token]) . "\n";
    }

    echo Html::tag('link', null, [
        'rel' => 'stylesheet',
        'href' => '//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic,cyrillic-ext'
    ]);
    echo Html::tag('link', null, ['rel' => 'canonical', 'href' => \yii\helpers\Url::canonical()]);
    echo Html::tag('link', null, ['rel' => 'shortcut icon', 'href' => '/favicon.ico']);
    echo Html::tag('link', null, ['rel' => 'apple-touch-icon', 'href' => '/img/apple-touch-icon.png']);
    echo Html::tag('link', null, ['rel' => 'apple-touch-icon', 'href' => '/img/apple-touch-icon-72x72.png']);
    echo Html::tag('link', null, ['rel' => 'apple-touch-icon', 'href' => '/img/apple-touch-icon-114x114.png']);

    $this->head()
    ?>
</head>

<body>
<?

$this->beginBody();

echo $content;

echo $this->render('_toast');

$this->endBody();

?>
</body>
</html><?

$this->endPage();