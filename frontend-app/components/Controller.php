<?php
/**
 * Controller.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\components;

/**
 * Class Controller
 * @package frontend\components
 */
class Controller extends \yii\web\Controller
{

    use \common\helpers\UseSslTrait;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->checkUseSsl(true);

        if (isset($_GET['clear'])) {
            \Yii::$app->get('cache')->flush();
            \Yii::$app->get('schemaCache')->flush();
            \Yii::$app->get('sessionCache')->flush();
            \Yii::$app->get('authManagerCache')->flush();
        }

        if (!User()->isGuest) {
            /** @var \resources\User $User */
            $User = User()->identity;

            if (true !== $User->isAvailable() && true !== $this->public) {
                switch ($User->isAvailable()) {
                    case 'not-activated':
                        throw new \yii\web\ForbiddenHttpException(\Yii::t('account', 'Ваш аккаунт не активирован'));
                    case 'deleted':
                        throw new \yii\web\ForbiddenHttpException(\Yii::t('account', 'Ваш аккаунт удалён'));
                }
            }
        }
    }

    public function __destruct()
    {
    }
}