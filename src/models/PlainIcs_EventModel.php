<?php
/**
 * craft-plain-ics plugin for Craft CMS 3.x
 *
 * @link      http://plainlanguage.co/
 * @copyright Copyright (c) 2018 Plain Language
 * @license   MIT License https://opensource.org/licenses/MIT
 */

namespace plainlanguage\plainIcs\models;

use plainlanguage\plainIcs\PlainIcs;

use Craft;
use craft\base\Model;

use Eluceo\iCal\Component\Calendar as iCal;
use Eluceo\iCal\Component\Event as iCalEvent;
use Eluceo\iCal\Component\Alarm as iCalAlarm;

/**
 * Plain ICS Event model
 *
 * @author    Plain Language
 * @package   PlainIcs
 * @since     0.0.2
 */
class PlainIcs_EventModel extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $startDateTime;

    /**
     * @var string
     */
    public $endDateTime;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $location;

    /**
     * @var string
     */
    public $locationTitle;

    /**
     * @var string
     */
    public $locationGeo;

    /**
     * @var string
     */
    public $filename;

    /**
     * @var string
     */
    public $alarmTrigger;

    /**
     * @var string
     */
    public $alarmAction;

    /**
     * @var string
     */
    public $alarmDescription;

    /**
     * Force-download the .ics file according to my opinion.
     *
     * @return iCal
     */
    public function ical()
    {
        $timezone = new \DateTimeZone(Craft::$app->getTimeZone());

        $vCalendar = new iCal(Craft::$app->config->general->siteUrl || 'site');
        $vEvent    = new iCalEvent();
        $vAlarm    = new iCalAlarm();
        $startDate = new \DateTime($this->startDateTime, $timezone);
        $endDate   = new \DateTime($this->endDateTime, $timezone);

        if ($this->alarmAction) {
            $vAlarm
                ->setTrigger($this->alarmTrigger)
                ->setAction($this->alarmAction)
                ->setDescription($this->alarmDescription);
        }

        $vEvent
            ->setDtStart($startDate)
            ->setDtEnd($endDate)
            ->setSummary($this->title)
            ->setDescription($this->description)
            ->setUrl($this->url)
            ->setLocation($this->location, $this->locationTitle, $this->locationGeo)
            ->setUseTimezone(true)
            ->setTimeTransparency('TRANSPARENT');

        if ($this->alarmAction) {
            $vEvent->addComponent($vAlarm);
        }

        $vCalendar->addEvent($vEvent);

        return $vCalendar;
    }
}
