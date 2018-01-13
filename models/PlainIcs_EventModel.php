<?php
namespace Craft;

require __DIR__ . '/../vendor/autoload.php';

use Eluceo\iCal\Component\Calendar as iCal;
use Eluceo\iCal\Component\Event as iCalEvent;
use Eluceo\iCal\Component\Alarm as iCalAlarm;

class PlainIcs_EventModel extends BaseModel
{

    /**
     * String output.
     *
     * @return string
     */
    function __toString()
    {
        return $this->title;
    }

    /**
     * Define the model attributes.
     *
     * @return array
     */
    protected function defineAttributes()
    {
        // Note that our datetimes can't be AttributeType:DateTime,
        // otherwise they'll lose the time component.
        return [
            'title'         => AttributeType::String,
            'startDateTime' => AttributeType::String,
            'endDateTime'   => AttributeType::String,
            'description'   => AttributeType::String,
            'url'           => AttributeType::String,
            'location'      => AttributeType::String,
            'locationTitle' => AttributeType::String,
            'locationGeo'   => AttributeType::String,
            'filename'      => AttributeType::String,
            'alarmTrigger'  => AttributeType::String,
            'alarmAction'   => AttributeType::String,
            'alarmDescription' => AttributeType::String,
        ];
    }

    /**
     * Force-download the .ics file according to my opinion.
     *
     * @return iCal
     */
    public function ical()
    {
        $timezone = new \DateTimeZone(craft()->timeZone);

        $vCalendar = new iCal(craft()->config->get('environmentVariables')['siteUrl']);
        $vEvent    = new iCalEvent();
        $vAlarm    = new iCalAlarm();
        $startDate = new DateTime($this->startDateTime, $timezone);
        $endDate   = new DateTime($this->endDateTime, $timezone);

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
