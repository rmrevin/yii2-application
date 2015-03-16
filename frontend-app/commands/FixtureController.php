<?php
/**
 * FixtureController.php
 * @author Revin Roman http://phptime.ru
 */

namespace frontend\commands;

/**
 * Class FixtureController
 * @package frontend\commands
 */
class FixtureController extends \common\commands\FixtureController
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