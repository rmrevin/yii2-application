<?php
/**
 * Controller.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\components;

use common;
use frontend;
use rmrevin\yii\minify\HtmlCompressor;
use services\Activity\models\Activity;
use services\Geo;
use yii\base\Event;
use yii\web\Response;

/**
 * Class Controller
 * @package frontend\components
 */
class Controller extends \yii\web\Controller
{

    use common\helpers\UseSslTrait;

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
        Activity::saveAll();
    }
}