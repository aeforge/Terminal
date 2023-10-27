<?php

namespace Aeforge\Terminal;
use Aeforge\Terminal\Exceptions\ConfigFileNotFoundException;
/**
 * class Config
 * 
 * @author AEForge <https://github.com/aeforge>
 */
class Config {
    /**
     * Config file name
     */
    const CONFIG_NAME = "Colors";
    /**
     * Stored configuration
     *
     * @var array
     */
    private $config;
    /**
     * Constructor
     * @access public
     * @return void
     */
    public function __construct()
    {
        $configPath = $this->configurationPath();

        $configFile = $configPath . self::CONFIG_NAME . ".php";

        if (!file_exists($configFile)) {
            throw new ConfigFileNotFoundException();
        }

        $this->config = require $configFile;
    }
    /**
     * Returns real path for the config folder
     *  @access private
     * @return string
     */
    private function configurationPath()
    {
        $config_path = __DIR__ . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR;

        return $config_path;
    }
    /**
     * Returns a value associated with the key
     * @access public
     * @param string $key
     * @return mixed Null if key is not found
     */
    public function get($key)
    {
     return array_key_exists($key, $this->config) ? $this->config[$key] : null;
    }
}