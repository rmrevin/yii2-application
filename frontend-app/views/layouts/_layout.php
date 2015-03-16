<?php
/**
 * _layout.php
 * @author Revin Roman http://phptime.ru
 *
 * @var yii\web\View $this
 * @var string $content
 */

use yii\helpers\Html;

$this->beginPage();

frontend\_assets\AppAsset::register($this);

?><!DOCTYPE html>
<?= Html::beginTag('html', [
    'lang' => Yii::$app->language,
    'ng-app' => 'YiiApp',
]) ?>
<head>
    <?
    echo Html::csrfMetaTags();
    echo Html::tag('title', Html::encode($this->title) . ' ~ Sitename');

    echo Html::tag('meta', '', ['charset' => Yii::$app->charset]);
    echo Html::tag('meta', '', ['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge']);
    echo Html::tag('meta', '', [
        'name' => 'viewport',
        'content' => 'width=device-width, initial-scale=1, maximum-scale=1'
    ]);

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
<? $this->beginBody() ?>

<?= $content ?>

<? $this->endBody() ?>
</body>
</html><?

$this->endPage();