<?php
/**
 * GetByIndexTrait.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\helpers;

/**
 * Trait GetByIndexTrait
 * @package common\helpers
 */
trait GetByIndexTrait
{

    /**
     * @param integer $index
     * @return null|array
     */
    public function getByIndex($index)
    {
        $data = $this->getData();

        return isset($data[$index]) ? $data[$index] : null;
    }
} 