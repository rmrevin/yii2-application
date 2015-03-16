<?php
/**
 * UserController.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\commands;

use frontend\modules\Account;
use yii;

/**
 * Class UserController
 * @package frontend\commands
 */
class UserController extends yii\console\Controller
{

    /**
     * метод создает пользователя и назначает его админом
     * @param string $email
     * @param string $name
     * @param string $pass
     * @return int
     */
    public function actionAdd($email = '', $name = '', $pass = '')
    {
        if (empty($email)) {
            $email = $this->prompt('Enter user email:', [
                'required' => true,
            ]);
        }

        if (empty($name)) {
            $name = $this->prompt('Enter user name:', [
                'required' => true,
            ]);
        }

        if (empty($pass)) {
            $pass = $this->prompt('Enter user password:', [
                'required' => true,
            ]);
        }

        $User = new Account\models\User([
            'gender' => Account\models\User::MALE,
            'name' => $name,
            'email' => $email,
            'activated' => Account\models\User::ACTIVATED,
            'deleted' => Account\models\User::NOT_DELETED,
            'password' => $pass,
        ]);
        $User->setScenario(Account\models\User::SCENARIO_REGISTER);

        $User->save();
        if (!$User->hasErrors()) {
            AuthManager()->assign(new yii\rbac\Role(['name' => Account\models\User::ROLE_ADMIN]), $User->id);

            $this->stdout("User have been successfully added\n", yii\helpers\Console::FG_GREEN);
        } else {
            $this->stdout("ERROR creating user\n", yii\helpers\Console::FG_RED);

            $error = array_shift($User->getFirstErrors());
            if (!empty($error)) {
                $this->stdout("\t> {$error}\n", yii\helpers\Console::FG_RED);
            }

            return static::EXIT_CODE_ERROR;
        }

        return static::EXIT_CODE_NORMAL;
    }
}