<?php
/**
 * UserAvailableTrait.php
 * @author Revin Roman http://phptime.ru
 */

namespace resources\User\traits;

/**
 * Class UserAvailableTrait
 * @package resources\User\traits
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
                case \resources\User::NOT_DELETED:
                    break;
                case \resources\User::DELETED:
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
        return $this->deleted === \resources\User::DELETED;
    }

    /**
     * @return bool
     */
    public function isNotDeleted()
    {
        return $this->deleted === \resources\User::NOT_DELETED;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function delete()
    {
        $this->deleted = \resources\User::DELETED;

        return $this->update(false, ['deleted']) === 1;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function restore()
    {
        $this->deleted = \resources\User::NOT_DELETED;

        return $this->update(false, ['deleted']) === 1;
    }
}