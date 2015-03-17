<?php
/**
 * UserCommand.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\commands;

use rmrevin\yii\rbac\RbacFactory;

/**
 * Class UserCommand
 * @package frontend\commands
 */
class UserCommand extends \yii\console\Controller
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

        $User = new \resources\User([
            'name' => $name,
            'email' => $email,
            'deleted' => \resources\User::NOT_DELETED,
            'password' => $pass,
        ]);

        $User->save();
        if (!$User->hasErrors()) {
            AuthManager()->assign(RbacFactory::Role(\resources\User::ROLE_ADMIN), $User->id);

            $this->stdout("User have been successfully added\n", \yii\helpers\Console::FG_GREEN);
        } else {
            $this->stdout("ERROR creating user\n", \yii\helpers\Console::FG_RED);

            $error = array_shift($User->getFirstErrors());
            if (!empty($error)) {
                $this->stdout("\t> {$error}\n", \yii\helpers\Console::FG_RED);
            }

            return static::EXIT_CODE_ERROR;
        }

        return static::EXIT_CODE_NORMAL;
    }
}