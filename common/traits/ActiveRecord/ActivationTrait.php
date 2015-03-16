<?php
/**
 * ActivationTrait.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\traits\ActiveRecord;

/**
 * Trait ActivationTrait
 * @package common\traits
 *
 * @property boolean $activated
 *
 * @method update
 */
trait ActivationTrait
{

    /**
     * @return bool
     */
    public function activate()
    {
        $this->activated = 1;

        return $this->update(false, ['activated']) === 1;
    }

    /**
     * @return bool
     */
    public function deactivate()
    {
        $this->activated = 0;

        return $this->update(false, ['activated']) === 1;
    }
}