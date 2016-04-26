<?php
namespace Craft;

require __DIR__ . '/../vendor/autoload.php';

use Eluceo\iCal\Component\Calendar as iCal;
use Eluceo\iCal\Component\Event as iCalEvent;

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
        return [
            'title'         => AttributeType::String,
            'startDate'     => AttributeType::DateTime,
            'startTime'     => AttributeType::DateTime,
            'endDate'       => AttributeType::DateTime,
            'endTime'       => AttributeType::DateTime,
            'description'   => AttributeType::String,
            'url'           => AttributeType::String,
            'location'      => AttributeType::String,
            'locationTitle' => AttributeType::String,
            'locationGeo'   => AttributeType::String,
            'filename'      => AttributeType::String,
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

        $vCalendar = new iCal(craft()->config->get('siteUrl'));
        $vEvent    = new iCalEvent();

        $startDate = new DateTime($this->startDate . ' ' . $this->startTime, $timezone);
        $endDate   = new DateTime($this->startDate . ' ' . $this->endTime, $timezone);

        $vEvent
            ->setDtStart($startDate)
            ->setDtEnd($endDate)
            ->setSummary($this->title)
            ->setDescription($this->description)
            ->setUrl($this->url)
            ->setLocation($this->location, $this->locationTitle, $this->locationGeo)
            ->setUseTimezone(true)
            ->setTimeTransparency('TRANSPARENT');

        $vCalendar->addEvent($vEvent);

        return $vCalendar;
    }

}