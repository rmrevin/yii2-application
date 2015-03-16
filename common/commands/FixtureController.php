<?php
/**
 * FixtureController.php
 * @author Revin Roman http://phptime.ru
 */

namespace common\commands;

use yii\base\Exception;
use yii\helpers\Console;
use yii\helpers\FileHelper;

/**
 * Class FixtureController
 * @package common\commands
 */
class FixtureController extends \yii\faker\FixtureController
{

    /**
     * @var string Alias to the template path, where all tables templates are stored.
     */
    public $templatePath = '@tests/fixtures/_templates';
    /**
     * @var string Alias to the fixture data path, where data files should be written.
     */
    public $fixtureDataPath = '@tests/fixtures/_data';

    /**
     * @inheritdoc
     */
    public function getFixtureData($template, $index = null)
    {
        $fixture = \Yii::getAlias($this->fixtureDataPath) . '/' . $template . '.php';
        if (!file_exists($fixture)) {
            throw new Exception(sprintf('Fixture data file `%s` not found', $fixture));
        }
        $data = require($fixture);

        return null === $index ? $data : $data[$index];
    }

    /**
     * @param callable $schema
     * @return int|void
     */
    public function actionGen(callable $schema)
    {
        $foundTemplates = $this->findTemplatesFiles();

        if (!$foundTemplates) {
            $this->notifyNoTemplatesFound();
            return static::EXIT_CODE_NORMAL;
        }

        if (!$this->confirmGeneration($foundTemplates)) {
            return static::EXIT_CODE_NORMAL;
        }

        $templatePath = \Yii::getAlias($this->templatePath);
        $fixtureDataPath = \Yii::getAlias($this->fixtureDataPath);

        FileHelper::createDirectory($fixtureDataPath);

        $this->notifyGenerated(call_user_func($schema, $templatePath, $fixtureDataPath));
    }

    /**
     * Generates fixture file by the given fixture template file.
     * @param string $templateName template file name
     * @param string $templatePath path where templates are stored
     * @param string $fixtureDataPath fixture data path where generated file should be written
     * @param integer $count
     * @param bool $force
     */
    public function generateFixtureFile($templateName, $templatePath, $fixtureDataPath, $count = 1, $force = false)
    {
        $fixtures = [];

        for ($i = 0; $i < $count; $i++) {
            $fixtures[$i] = $this->generateFixture($templatePath . '/' . $templateName . '.php', $i);
        }

        $content = $this->exportFixtures($fixtures);

        $fixtureFileName = $fixtureDataPath . '/' . $templateName . '.php';
        if (!file_exists($fixtureFileName) || true === $force) {
            file_put_contents($fixtureFileName, $content);
        }
    }

    /**
     * Lists all available fixtures template files.
     * @param array $templatesNames
     * @return array
     */
    protected function findTemplatesFiles(array $templatesNames = [])
    {
        $findAll = ($templatesNames == []);

        if ($findAll) {
            $files = FileHelper::findFiles(\Yii::getAlias($this->templatePath), ['only' => ['*.php']]);
        } else {
            $filesToSearch = [];

            foreach ($templatesNames as $fileName) {
                $filesToSearch[] = $fileName . '.php';
            }

            $files = FileHelper::findFiles(\Yii::getAlias($this->templatePath), ['only' => $filesToSearch]);
        }

        $foundTemplates = [];

        foreach ($files as $fileName) {
            $foundTemplates[] = basename($fileName, '.php');
        }

        return $foundTemplates;
    }

    /**
     * Notifies user that there was not found any files matching given input conditions.
     */
    protected function notifyNoTemplatesFound()
    {
        $this->stdout("No fixtures template files matching input conditions were found under the path:\n\n", Console::FG_RED);
        $this->stdout("\t " . \Yii::getAlias($this->templatePath) . " \n\n", Console::FG_GREEN);
    }

    /**
     * Notifies user that given fixtures were generated.
     * @param array $generated
     */
    protected function notifyGenerated($generated)
    {
        $this->stdout("The following fixtures were generated:\n\n", Console::FG_YELLOW);

        foreach ($generated as $key => $count) {
            $this->stdout("\t* " . $key . ": " . $count . "\n", Console::FG_GREEN);
        }

        $this->stdout("\n");
    }
}