<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfSecurityConfigHandler allows you to configure action security.
 *
 * @package    symfony
 * @subpackage config
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfSecurityConfigHandler.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfSecurityConfigHandler extends sfYamlConfigHandler
{
    /**
     * Executes this configuration handler.
     *
     * @param array $configFiles An array of absolute filesystem path to a configuration file
     *
     * @return string Data to be written to a cache file
     *
     * @throws <b>sfConfigurationException</b> If a requested configuration file does not exist or is not readable
     * @throws <b>sfParseException</b> If a requested configuration file is improperly formatted
     * @throws <b>sfInitializationException</b> If a view.yml key check fails
     */
    public function execute($configFiles)
    {
        // parse the yaml
        $config = self::getConfiguration($configFiles);

        // compile data
        $retval = sprintf("<?php\n" .
            "// auto-generated by sfSecurityConfigHandler\n" .
            "// date: %s\n\$this->security = %s;\n",
            date('Y/m/d H:i:s'), var_export($config, true));

        return $retval;
    }

    /**
     * @see sfConfigHandler
     */
    static public function getConfiguration(array $configFiles)
    {
        $config = self::flattenConfiguration(self::parseYamls($configFiles));

        // change all of the keys to lowercase
        $config = array_change_key_case($config);

        return $config;
    }
}
