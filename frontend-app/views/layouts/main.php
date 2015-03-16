<?php
/**
 * main.php
 * @author Revin Roman http://phptime.ru
 *
 * @var yii\web\View $this
 * @var string $content
 */

$this->beginContent('@app/views/layouts/_layout.php', ['content' => $content]);

?>

    <div id="page-loader"><span class="page-loader-gif"></span></div>

    <div class="body">
        <?= $content ?>
    </div>

<?

$this->endContent();