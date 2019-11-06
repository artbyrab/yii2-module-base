<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Module settings command
 *
 * This command will allow you to find and replace various text in the module
 * from a settings file to make it easier to build your own module
 *
 * Linux SED tutorial:
 *  - http://brunolinux.com/02-The_Terminal/Find_and%20Replace_with_Sed.html
 * Better tutorial using grep and ignoring various folders:
 *  - https://www.developwebsites.net/grep-sed-search-replace-text-beware-git/
 * Understanding that SED supports more than 1 delimeter, we will use # as / is in some of the paths
 *  - https://stackoverflow.com/questions/22182050/sed-e-expression-1-char-23-unknown-option-to-s
 * Understand that grep requires various flags to property parse things
 *  - its requires -F to process \ backslashes which we have in various values
 *      - https://unix.stackexchange.com/questions/31306/grep-trailing-backslash
 *
 * This is the grep style command to use from the src/ folder:
 *  - grep -rl --exclude-dir='runtime' --exclude-dir='commands' "artbyrab" '../'
 *
 * And combined you would end up with:
 *  - grep -rlF --exclude=*.json --exclude-dir='runtime' --exclude-dir='commands' --exclude-dir='documents' "artbyrab" '../' | xargs sed -i 's#matchstring#replacestring#g'
 *
 * So in an easier to read format it might look like:
 *  - grep -rlF --exclude=*.json --exclude-dir='runtime' --exclude-dir='commands' --exclude-dir='documents' "{matchString}" '{folder}' | xargs sed -i 's#{matchString}#{replaceString}#g'
 *
 * @author artbyrab
 */
class ModuleSettingsController extends Controller
{
    /**
     * @var boolean
     */
    public $debugMode = true;

    /**
     * @var boolean
     */
    public $dryrun = true;

    /**
     * @var string The folder that holds the files we will find and replace in.
     *
     * We will only replace in the Yii2ModuleBase/src folder and we need to
     * ignore certain folders. For example we will ignore:
     *  - Yii2ModuleBase/src/runtime
     *  - Yii2ModuleBase/src/tests/app/commands
     */
    public $replaceFolder;

    /**
     * @var string
     */
    public $moduleSettingsFile;

    /**
     * @var array Holds the module-settings.json as a php array used to replace
     * the values in the $findModuleSettings
     */
    private $moduleSettingsArray;

    /**
     * @var array Holds the origional module-settings data
     */
    private $defaultModuleSettingsArray = array(
        // "author" => "artbyrab",
        // "author-slug" => "artbyrab",
        // "package-name" => "Yii2ModuleBase",
        // "package-name-slug" => "Yii2ModuleBase",
        // "package-name-camel-no-prefix" => "moduleBase",
        // "module-default-route" => "module-base",
        
        //"composer-package" => "artbyrab/yii2-module-base",
        //"namespace" => "artbyrab\\Yii2ModuleBase",
        "package-name-camel-case" => "Yii2ModuleBase",
        "package-name" => "Yii2 Module Base",
        "package-author-name" => "artbyrab",
        "config-package-name-and-route" => "module-base",
        "rbac-admin-name-camel-case" => "moduleBaseAdmin",
        "rbac-admin-name-studly-caps" => "ModuleBaseAdmin",
    );

    /**
     * Action Replace
     *
     * This will replace the variables in your message-settings.json file with
     * the values in the module-settings-default.json file.
     *
     * You can set the $moduleSettingsFile and $replaceFolder attributes
     * manually if you require before you run this command.
     *
     * @param boolean $dryrun Set to True to see what would have been changed
     * without making any changes.
     * @return int Exit code
     */
    public function actionReplace($dryrun=false)
    {
        echo "Module Settings Command - Action Replace starting" . "\n";

        $this->checkWeAreOnLinuxServer();

        $this->dryrun = $dryrun;

        if (empty($this->moduleSettingsFile)) {
            $this->moduleSettingsFile = dirname(dirname(dirname(dirname(__DIR__)))) . '/module-settings.json';
        }

        if (empty($this->replaceFolder)) {
            $this->replaceFolder = dirname(dirname(dirname(__DIR__)));
        }

        $this->checkModuleSettingsFileExists();

        $this->checkModuleSettingsFileIsPopulated();

        $this->parseModuleSettingsFileIntoArray();

        // for each modules settings array
        foreach ($this->defaultModuleSettingsArray as $key => $value) {
            $matchString = $value;
            $replaceString = $this->moduleSettingsArray[$key];

            $this->replaceFromToInFolder($matchString, $replaceString, $this->replaceFolder);
        }

        echo "Module Settings Command - Action Replace finished successfully" . "\n";

        return ExitCode::OK;
    }

    /**
     * Action Reverse Replace
     *
     * This will replace the other way, setting the default module settings in
     * place of the module settings.
     *
     * @param boolean $dryRun Set to True to see what would have been changed
     * without making any changes.
     * @return int Exit code
     */
    public function actionReverseReplace($dryrun=false)
    {
        echo "Module Settings Command - Action Reverse Replace starting" . "\n";

        $this->checkWeAreOnLinuxServer();

        $this->dryrun = $dryrun;

        if (empty($this->moduleSettingsFile)) {
            $this->moduleSettingsFile = dirname(dirname(dirname(dirname(__DIR__)))) . '/module-settings.json';
        }

        if (empty($this->replaceFolder)) {
            $this->replaceFolder = dirname(dirname(dirname(__DIR__)));
        }

        $this->checkModuleSettingsFileExists();

        $this->checkModuleSettingsFileIsPopulated();

        $this->parseModuleSettingsFileIntoArray();

        // for each modules settings array
        foreach ($this->defaultModuleSettingsArray as $key => $value) {
            $matchString = $this->moduleSettingsArray[$key];
            $replaceString = $value;

            $this->replaceFromToInFolder($matchString, $replaceString, $this->replaceFolder);
        }

        echo "Module Settings Command - Action Reverse Replace finished successfully" . "\n";

        return ExitCode::OK;
    }

    /**
     * Check to ensure we are on a linux server
     *
     * @return boolean
     * @throws Exception
     */
    private function checkWeAreOnLinuxServer()
    {
        if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
            throw new \Exception('Module Settings Command - This command cannot be run on a Windows server as it uses the linux "grep" and "sed" commands. Please replace the settings manually.');
        }

        echo " * We are on a linux server" . "\n";
            
        return true;
    }

    /**
     * Check Module Settings File Exists.
     *
     * @return boolean
     * @throws Exception
     */
    private function checkModuleSettingsFileExists($echoResult=true)
    {
        if (file_exists($this->moduleSettingsFile)) {
            if ($echoResult == true) {
                echo " - The module settings file exists at " . $this->moduleSettingsFile . "\n";
            }

            return true;
        }

        throw new \Exception('Module Settings Command - module-settings.json file does not exist at . ' . $this->moduleSettingsFile);
    }

    /**
     * Check Module Settings File is Populated.
     *
     * @return boolean
     * @throws Exception
     */
    private function checkModuleSettingsFileIsPopulated($echoResult=true)
    {
        if ($this->checkModuleSettingsFileExists(false) == true) {
            $fileContents = file_get_contents($this->moduleSettingsFile);
            $array = json_decode($fileContents, true);

            foreach ($array as $key => $value) {
                if (empty($value)) {
                    throw new \Exception('Module Settings Command - module-settings.json file value does not exist, please populate it . ' . $key);
                }
            }

            if ($echoResult == true) {
                echo " - The module settings file is populated as follows: ";
                print_r($array);
                echo "\n";
            }
            
            return true;
        }
    }

    /**
     * Check Module Settings File Exists.
     *
     * @return boolean
     * @throws Exception
     */
    private function parseModuleSettingsFileIntoArray()
    {
        if ($this->checkModuleSettingsFileExists(false) == true && $this->checkModuleSettingsFileIsPopulated(false)) {
            $fileContents = file_get_contents($this->moduleSettingsFile);
            $array = json_decode($fileContents, true);

            $this->moduleSettingsArray = $array;

            echo " - The module settings file was parsed into an array successfully" . "\n";

            return true;
        }
    }

    /**
     * Replace from and to in the folder
     *
     * @return boolean
     * @throws Exception
     */
    private function replaceFromToInFolder($matchString, $replaceString, $folder)
    {
        # grep -rl --exclude=*.json --exclude-dir='runtime' --exclude-dir='commands' --exclude-dir='documents' "{matchString}" '{folder}' | xargs sed -i 's#{matchString}#{replaceString}#g'
        $command = "grep -rl --exclude=*.json --exclude-dir='runtime' --exclude-dir='commands' --exclude-dir='documents' '{matchString}' '{folder}' | xargs sed -i 's#{matchString}#{replaceString}#g'";

        $placeholders = array(
            '{folder}',
            '{matchString}',
            '{replaceString}',
        );

        $replacements = array(
            $folder,
            $matchString,
            $replaceString,
        );

        $replacedCommand = str_replace($placeholders, $replacements, $command);

        if ($this->dryrun == true) {
            echo " - The following command was generated but not run:" . "\n";
            echo "      - " . $replacedCommand . "\n";
        }

        if ($this->dryrun == false) {
            $this->runCommand($replacedCommand, 'replaceFromToInFolder');

            echo " - The following command was run:" . "\n";
            echo "      - " . $replacedCommand . "\n";

            return true;
        }
    }

    /**
     * Run
     *
     * This is just a wrapper for some common functionality shared with php
     * exec command.
     *
     * @param string $command is the query to run.
     * @param string $functionName is the name of the function you are running
     * for displaying output if debug mode is True.
     * @return boolean
     * @throws Exception
     */
    public function runCommand($command, $functionName)
    {
        // execute the command
        exec($command, $out, $status);
        
        // if the status is 0 then the command worked
        if (0 === $status) {
            return true;
            
        // otherwise it failed so lets raise an exception
        } else {
            throw new \Exception(
                'Module Settings Command:' .
                $functionName . ' Error: ' .
                'Status Code:' . $status . ' - Command: ' . $command
            );
        }
    }
}
