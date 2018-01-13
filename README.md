# Plain ICS for [Craft CMS](https://craftcms.com)

A Craft CMS plugin that implements [eluceo/iCal](https://github.com/eluceo/iCal) package for creating ICS files in your Twig templates.

## Twig Variables

### `render`

The plugin includes a single Twig variable, `render`, which accepts an array/object of parameters to render the iCal event.

#### Parameters

- Title `title` - String
- Start Date Time `startDateTime` - a properly formatted `DateTime` object in Craft.
- End Date Time `endDateTime` - a properly formatted `DateTime` object in Craft.- Description `description` - String
- URL `url` - String
- Location `location` - String
- Location Title `locationTitle` - String
- Location Geo `locationGeo` - String, lat/lng
- Filename `filename` - String, optionally set the filename for the downloaded file, defaults to `cal.ics`.
- Alarm Action `alarmAction` - String (one of `DISPLAY`, `AUDIO`, `EMAIL`)
- Alarm Description `alarmDescription` - String
- Alarm Trigger `alarmTrigger` - String (e.g. `-PT30M` for 30 minutes before the event)

#### Example Twig Template

Assumes that `entry` is defined by Craft and that all of the appropriate custom fields exist:

    {% if entry is defined %}

        {% set event = {
            'title'           : entry.title,
            'description'     : entry.description,
            'startDateTime'   : entry.dateStart | date('Y-m-d H:i:sP'),
            'endDateTime'     : entry.dateEnd | date('Y-m-d H:i:sP'),
            'url'             : entry.url,
            'location'        : entry.location,
            'alarmAction'     : 'DISPLAY',
            'alarmDescription': entry.alarmDescription,
            'alarmTrigger'    : entry.alarmTrigger // e.g. '-PT30M'

        } %}

        {{ craft.plainIcs.render(event) }}

    {% endif %}

