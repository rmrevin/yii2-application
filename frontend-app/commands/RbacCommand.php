<?php
/**
 * RbacCommand.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\commands;

use crm\Permissions as P;
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
            RF::Permission(P::ACCESS, 'Имеет доступ к системе'),
            /** Account module */
            RF::Permission(P::ACCOUNT_ACCESS, 'Имеет доступ к модулю пользователей'),
            /** Calendar module */
            RF::Permission(P::CALENDAR_ACCESS, 'Имеет доступ к модулю кулендаря'),
            /** Client module */
            RF::Permission(P::CLIENT_ACCESS, 'Имеет доступ к модулю клиентов'),
            /** Event module */
            RF::Permission(P::EVENT_ACCESS, 'Имеет доступ к модулю акций'),
            /** Order module */
            RF::Permission(P::ORDER_ACCESS, 'Имеет доступ к модулю заказов'),
            /** Comment module */
            RF::Permission(P::COMMENT_CREATE, 'Может создавать комментарии'),
            RF::Permission(P::COMMENT_UPDATE, 'Может изменять все комментарии'),
            RF::Permission(P::COMMENT_UPDATE_OWN, 'Может изменять свои комментарии'),
            RF::Permission(P::COMMENT_DELETE, 'Может удалять все комментарии'),
            RF::Permission(P::COMMENT_DELETE_OWN, 'Может удалять свои комментарии'),
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
                P::ACCOUNT_ACCESS,
                P::COMMENT_UPDATE,
                P::COMMENT_DELETE,
            ],
            P::ROLE_MANAGER => [
                P::CALENDAR_ACCESS,
                P::CLIENT_ACCESS,
                P::EVENT_ACCESS,
                P::ORDER_ACCESS,
                P::COMMENT_CREATE,
                P::COMMENT_UPDATE_OWN,
                P::COMMENT_DELETE_OWN,
            ],
            P::ROLE_USER => [
                P::ACCESS,
            ],
        ];
    }
}