<?php
namespace Craft;

require __DIR__.'/vendor/autoload.php';

class PlainIcsPlugin extends BasePlugin
{
    /**
     * Initialize the plugin.
     */
    public function init()
    {
    }

    /**
     * The plugin name.
     *
     * @return string
     */
    public function getName()
    {
        return 'Plain ICS.';
    }

    /**
     * The plugin description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return 'A Craft CMS plugin that implements [eluceo/iCal](https://github.com/eluceo/iCal/releases) package for creating ICS files in Twig.';
    }

    /**
     * @inheritdoc
     *
     * @return string
     */
    public function getDeveloper()
    {
        return 'Plain Language.';
    }

    /**
     * Commerce Developer URL.
     *
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'https://plainlanguage.co';
    }

    /**
     * Commerce Documentation URL.
     *
     * @return string
     */
    public function getDocumentationUrl()
    {
        return 'https://github.com/plainlanguage/craft-plain-ics';
    }

    /**
     * Commerce has a control panel section.
     *
     * @return bool
     */
    public function hasCpSection()
    {
        return false;
    }

    /**
     * Commerce Version.
     *
     * @return string
     */
    public function getVersion()
    {
        return '0.2';
    }

    /**
     * Commerce Schema Version.
     *
     * @return string|null
     */
    public function getSchemaVersion()
    {
        return '0.2';
    }

}
