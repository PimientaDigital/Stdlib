<?php

namespace Stdlib;

/**
 * Simple class used to set configuration and debugging depending on environment.
 * This allows for a path, debugging vars, and config array.
 *
 * Environment is determined by $_SERVER[YII_ENVIRONMENT], created
 * by Apache's SetEnv directive
 * This can be done in the httpd.conf or in a .htaccess file for ease of use.
 * See: http://httpd.apache.org/docs/1.3/mod/mod_env.html#setenv
 *
 */

use Stdlib/ArrayUtils;

class Environment
{

    const SERVER_VAR = 'APPLICATION_ENV';
    const MAIN_CONFIG = 'global.php';

    // Current mode
    private $_mode;

    // Environment properties
    private $_config;

    // Dir Config
    private $_dirconfig;

    /**
     * Initilizes the Environment class with the given mode
     * @param constant $mode
     */
    public function __construct($dirconfig, $mode = null)
    {
        $this->_dirconfig= $dirconfig;
        $this->_mode = $this->getMode($mode);
        $this->setEnvironment();
    }

    /**
     * Get current environment mode depending on environment variable
     * @param <type> $mode
     * @return <type>
     */
    private function getMode($mode = null)
    {
        // If not overriden
        if (!isset($mode)) {
            // Return mode based on Apache server var
            if (isset($_SERVER[self::SERVER_VAR]))
                $mode = $_SERVER[self::SERVER_VAR];
            else
                throw new Exception('SetEnv not defined in Apache config.');
        }

        return $mode;
    }

    /**
     * Sets the environment and configuration for the chosen mode
     * @param constant $mode
     */
    private function setEnvironment()
    {
        $dirconfig= $this->_dirconfig;

        // Load main config
        $configMainFile = $dirconfig . DIRECTORY_SEPARATOR . self::MAIN_CONFIG;
        if (!file_exists($configMainFile))
            throw new Exception('Cannot find config file "' . $configMainFile . '".');

        $config = include($configMainFile);

        // Load specific config
        $configFile = $dirconfig . DIRECTORY_SEPARATOR . 'mode_' . strtolower($this->_mode) . '.php';
        if (!file_exists($configFile))
            throw new Exception('Cannot find config file "' . $configFile . '".');

        $configEnvironment = include($configFile);

        // Merge config arrays into one
        $this->_config = ArrayUtils::merge($config, $configEnvironment);
    }

    /**
     * Returns the configuration array
     * @return array
     */
    public function getConfig()
    {
        return $this->_config;
    }

}

