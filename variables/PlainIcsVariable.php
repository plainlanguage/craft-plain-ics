<?php
namespace Craft;

class PlainIcsVariable
{

    /**
     * Render and force-download an .ics file
     * built from the passed in parameters array.
     *
     * @param array $parameters
     * @return exit
     */
    public function render($parameters = null)
    {
        // Require a non-null array of parameters.
        if (is_null($parameters) || !is_array($parameters)) {
            return false;
        }

        // Create our model.
        $event = new PlainIcs_EventModel();

        // Loop through parameters and populate the model.
        foreach ($parameters as $key => $parameter) {
            if (isset($event->$key)) {
                $event->$key = $parameter;
            }
        }

        // Set the filename for the .ics file.
        $filename = isset($event->filename) && !empty($event->filename) ? $event->filename : 'cal.ics';

        // Set headers.
        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Render the .ics file.
        echo $event->ical()->render();

        // Die
        exit;
    }

}