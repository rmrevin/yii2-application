<?php

use rmrevin\yii\rbac\RbacFactory;

class m150202_074500_rbac_first extends \common\components\RbacMigration
{

    protected function getNewRoles()
    {
        return [
            RbacFactory::Role('admin', 'Administrator'),
            RbacFactory::Role('manager', 'Manager'),
            RbacFactory::Role('user', 'User'),
        ];
    }

    protected function getInheritance()
    {
        return [
            'admin' => [
                'manager',
            ],
            'manager' => [
                'user',
            ],
            'user' => [
            ],
        ];
    }
}