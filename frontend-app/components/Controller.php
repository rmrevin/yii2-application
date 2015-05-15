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
            Cache()->flush();
        }
    }

    public function __destruct()
    {
    }
}