<?php

class m140415_063026_rbac extends \common\components\Migration
{

    public function safeUp()
    {
        $sql = file_get_contents(Yii::getAlias('@common/data/rbac-mysql.sql'));

        $this->execute($sql);

        echo '    m140415_063026_rbac imported.' . PHP_EOL;

        return true;
    }

    public function safeDown()
    {
        echo '    m140415_063026_rbac skip reverting.' . PHP_EOL;

        return true;
    }
}
