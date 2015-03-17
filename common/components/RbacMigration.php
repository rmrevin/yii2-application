<?php
/**
 * RbacMigration.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\components;

/**
 * Class RbacMigration
 * @package common\components
 */
abstract class RbacMigration extends \rmrevin\yii\rbac\RbacMigration
{

    use SwitchableMigrationTrait {
        switchTestDb as traitSwitchTestDb;
    }

    protected function switchTestDb()
    {
        $this->traitSwitchTestDb();

        AuthManager()->db = $this->db;
    }
}