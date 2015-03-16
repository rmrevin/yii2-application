<?php
/**
 * Migration.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\components;

/**
 * Class Migration
 * @package common\components
 */
class Migration extends \yii\db\Migration
{

    private $db_type = 'master';

    protected $only_master = false;

    /**
     * @inheritdoc
     */
    public function up()
    {
        echo "  > database `{$this->db_type}` ...\n";

        parent::up();
        if (!$this->isProduction()) {
            $this->switchTestDb();
            parent::up();
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        parent::down();
        if (!$this->isProduction()) {
            $this->switchTestDb();
            parent::down();
        }
    }

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        parent::up();
        if (!$this->isProduction()) {
            $this->switchTestDb();
            parent::up();
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        parent::down();
        if (!$this->isProduction()) {
            $this->switchTestDb();
            parent::down();
        }
    }

    /**
     * @inheritdoc
     */
    public function createTable($table, $columns, $options = null)
    {
        if ($options === null && $this->db->driverName === 'mysql') {
            $options = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        parent::createTable($table, $columns, $options);
    }

    /**
     * @return bool
     */
    private function isProduction()
    {
        return in_array(YII_ENV, ['prod', 'production']) || true === $this->only_master;
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    private function switchTestDb()
    {
        $this->db_type = $this->db_type === 'master' ? 'test' : 'master';
        $this->db = \Yii::$app->get($this->db_type === 'master' ? 'db' : 'db.test');

        echo "  > switch database to `{$this->db_type}` ...\n";
    }
}