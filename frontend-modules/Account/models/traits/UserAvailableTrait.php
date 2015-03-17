<?php
/**
 * UserAvailableTrait.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\modules\Account\models\traits;

use frontend\modules\Account;

/**
 * Class UserAvailableTrait
 * @package frontend\modules\Account\models\traits
 *
 * @property integer $deleted
 *
 * @method integer update
 */
trait UserAvailableTrait
{

    /**
     * @return bool|string
     */
    public function isAvailable()
    {
        $result = true;

        if ($result === true) {
            switch ($this->deleted) {
                default:
                case Account\models\User::NOT_DELETED:
                    break;
                case Account\models\User::DELETED:
                    $result = 'deleted';
                    break;
            }
        }

        return $result;
    }

    /**
     * @return bool
     */
    public function isDeleted()
    {
        return $this->deleted === Account\models\User::DELETED;
    }

    /**
     * @return bool
     */
    public function isNotDeleted()
    {
        return $this->deleted === Account\models\User::NOT_DELETED;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function delete()
    {
        $this->deleted = Account\models\User::DELETED;

        return $this->update(false, ['deleted']) === 1;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function restore()
    {
        $this->deleted = Account\models\User::NOT_DELETED;

        return $this->update(false, ['deleted']) === 1;
    }
}