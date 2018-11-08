<?php
/**
 * craft-plain-ics plugin for Craft CMS 3.x
 *
 * A Craft CMS plugin that implements the eluceo/iCal package for creating ICS files in your Twig templates.
 *
 * @link      http://plainlanguage.co/
 * @copyright Copyright (c) 2018 Plain Language
 * @license   MIT License https://opensource.org/licenses/MIT
 */

namespace plainlanguage\plainIcs;

use plainlanguage\plainIcs\variables\PlainIcsVariable;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\UrlManager;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Class PlainICS
 *
 * @author    Plain Language
 * @package   PlainIcs
 * @since     0.0.2
 */
class PlainIcs extends Plugin
{
    /**
     * @var PlainIcs
     */
    public static $plugin;

    /**
     *  @inheritdoc
     */
    public function init()
    {
        parent::init();

        self::$plugin = $this;

        $this->name = $this->getName();

        // Register our variables
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('plainIcs', PlainIcsVariable::class);
            }
        );

        Craft::info(
            Craft::t(
                'plain-ics',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    /**
     * Returns the user-facing name of the plugin, which can override the name
     * in composer.json
     *
     * @return string
     */
    public function getName()
    {
        return Craft::t('plain-ics', 'Plain ICS');
    }
}
