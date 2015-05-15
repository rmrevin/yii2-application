<?php
/**
 * RbacCommand.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\commands;

use frontend\Permissions as P;
use rmrevin\yii\rbac\RbacFactory as RF;

/**
 * Class RbacCommand
 * @package frontend\commands
 */
class RbacCommand extends \rmrevin\yii\rbac\Command
{

    /** @var string|null */
    public $forceAssign = 'user';

    /**
     * @return \yii\rbac\Role[]
     */
    protected function roles()
    {
        return [
            RF::Role(P::ROLE_ADMIN, 'Администратор'),
            RF::Role(P::ROLE_MANAGER, 'Менеджер'),
            RF::Role(P::ROLE_USER, 'Пользователь'),
        ];
    }

    /**
     * @return \yii\rbac\Rule[]
     */
    protected function rules()
    {
        return [];
    }

    /**
     * @return \yii\rbac\Permission[]
     */
    protected function permissions()
    {
        return [
            RF::Permission(P::ACCESS, 'Grant access'),
        ];
    }

    /**
     * @return array
     */
    protected function inheritanceRoles()
    {
        return [
            P::ROLE_ADMIN => [
                P::ROLE_MANAGER,
            ],
            P::ROLE_MANAGER => [
                P::ROLE_USER,
            ],
            P::ROLE_USER => [],
        ];
    }

    /**
     * @return array
     */
    protected function inheritancePermissions()
    {
        return [
            P::ROLE_ADMIN => [
            ],
            P::ROLE_MANAGER => [
            ],
            P::ROLE_USER => [
                P::ACCESS,
            ],
        ];
    }
}