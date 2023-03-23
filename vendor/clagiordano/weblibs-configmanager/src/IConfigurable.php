<?php

namespace clagiordano\weblibs\configmanager;

use RuntimeException;

/**
 * Class ConfigManager, class for easily read and access to php config array file.
 * @package clagiordano\weblibs\configmanager
 */
interface IConfigurable
{
    /**
     * Load config data from file and store it into internal property
     *
     * @param null|string $configFilePath
     *
     * @return IConfigurable
     */
    public function loadConfig($configFilePath = null);

    /**
     * Prepare and write config file on disk
     *
     * @param null|string $configFilePath
     * @param bool $autoReloadConfig
     *
     * @return IConfigurable
     * @throws RuntimeException
     */
    public function saveConfigFile($configFilePath = null, $autoReloadConfig = false);

    /**
     * Get value from config data throught keyValue path
     *
     * @param string $configPath
     * @param mixed $defaultValue
     *
     * @return mixed
     */
    public function getValue($configPath, $defaultValue = null);

    /**
     * Check if exist required config for keyValue
     *
     * @param string $keyValue
     *
     * @return mixed
     */
    public function existValue($keyValue);

    /**
     * Set value in config path
     *
     * @param string $configPath
     * @param mixed $newValue
     *
     * @return IConfigurable
     */
    public function setValue($configPath, $newValue);

    /**
     * Returns the whole internal configuration as array
     * @return array
     */
    public function getConfig();

    /**
     * Sets the whole internal configuration from array
     *
     * @param array $config
     * @return IConfigurable
     */
    public function setConfig($config);

    /**
     * Converts the current instance into another one provided as argument,
     * migrating its internal configuration and returning the new one.
     *
     * @param IConfigurable $target
     * @return IConfigurable
     */
    public function convert(IConfigurable $target);
}
