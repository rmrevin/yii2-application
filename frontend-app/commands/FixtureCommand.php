<?php
/**
 * FixtureCommand.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\commands;

/**
 * Class FixtureCommand
 * @package frontend\commands
 */
class FixtureCommand extends \common\commands\FixtureCommand
{

    /**
     * @return int|void
     */
    public function actionGen()
    {
        parent::actionGen(function ($templatePath, $fixtureDataPath) {
            $generated = [
                'New users' => 10,
            ];

            $this->generateFixtureFile('user', $templatePath, $fixtureDataPath, $generated['New users']);

            return $generated;
        });
    }
}