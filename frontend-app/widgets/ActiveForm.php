<?php
/**
 * ActiveForm.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\widgets;

/**
 * Class ActiveForm
 * @package frontend\widgets
 */
class ActiveForm extends \yii\widgets\ActiveForm
{

    /**
     * @inheritdoc
     */
    public $enableClientScript = false;

    /**
     * @inheritdoc
     */
    public $fieldClass = \frontend\components\ActiveField::class;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        if (!isset($this->options['name'])) {
            $this->options['name'] = strtolower($this->options['id']);
        }
        parent::init();
    }
}