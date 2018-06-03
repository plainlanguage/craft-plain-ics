<?php
/**
 * craft-plain-ics plugin for Craft CMS 3.x
 *
 * @link      http://plainlanguage.co/
 * @copyright Copyright (c) 2018 Plain Language
 * @license   MIT License https://opensource.org/licenses/MIT
 */

namespace plainlanguage\plainics\variables;

use plainlanguage\plainics\PlainIcs;

use Craft;

/**
 * Plain ICS template variables
 *
 * @author    Plain Language
 * @package   PlainICS
 * @since     0.0.2
 */
class PlainIcsVariable
{
    /**
     * Render and force-download an .ics file
     * built from the passed in parameters array
     * if $return is not true.
     * If $return is true, we'll simply return the
     * .ics contents built from the passed in parameters array.
     *
     * @param array $parameters
     * @param string $return
     * @return exit
     */
    public function render($parameters = null, $return = false)
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

        if ($return) {
            // Render the .ics file.
            return $event->ical()->render();
        }

        // Set headers.
        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Render the .ics file.
        echo $event->ical()->render();

        // Die
        exit;
    }
}
