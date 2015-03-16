<?php
/**
 * SoftDeleteTrait.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\traits\ActiveRecord;

use yii\base\InvalidConfigException;

/**
 * Trait SoftDeleteTrait
 * @package hub\modules\API\models\traits\rest
 *
 * Трейт переопределяет метод delete в ActiveRecord классе.
 * Теперь, при первом вызове метода delete, запись не будет физически удалена из базы данных,
 * а только лишь помечается удалённой (deleted=1)
 *
 * При повторном вызове метода delete, запись будет удалена полностью из базы
 *
 * @property bool $deleted
 * @method hasAttribute
 * @method hasProperty
 * @method update
 */
trait SoftDeleteTrait
{

    /**
     * @param bool $permanently если true, то запись будет безусловно удалена
     * @return integer|boolean количество удаленных строк, или false если призошла ошибка.
     * Помните, может быть удалено 0 (ноль) строк, и это считается успешным завершением метода.
     * @throws \yii\base\InvalidConfigException
     */
    public function delete($permanently = false)
    {
        if (!$this->hasAttribute('deleted') && !$this->hasProperty('deleted')) {
            throw new InvalidConfigException(sprintf(
                '`%s` has no attribute named `%s`.',
                get_class($this),
                'deleted'
            ));
        }

        if (true === $permanently || 1 === $this->deleted) {
            // permanently delete
            $result = parent::delete();
        } else {
            // soft delete
            $this->deleted = 1;
            $result = $this->update(false, ['deleted']);
        }

        return $result;
    }
}