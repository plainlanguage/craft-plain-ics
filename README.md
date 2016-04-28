# Plain ICS for [Craft CMS](https://craftcms.com)

A Craft CMS plugin that implements [eluceo/iCal](https://github.com/eluceo/iCal) package for creating ICS files in your Twig templates.

## Twig Variables

### `render`

The plugin includes a single Twig variable, `render`, which accepts an array/object of parameters to render the iCal event.

#### Parameters

- Title `title` - String
- Start Date `startDate` - a properly formatted `DateTime` object in Craft.
- Start Time `startTime` - a properly formatted `DateTime` object in Craft.
- End Date `endDate` - a properly formatted `DateTime` object in Craft.
- End Time `endTime` - a properly formatted `DateTime` object in Craft.
- Description `description` - String
- URL `url` - String
- Location `location` - String
- Location Title `locationTitle` - String
- Location Geo `locationGeo` - String, lat/lng
- Filename `filename` - String, optionally set the filename for the downloaded file, defaults to `cal.ics`.

#### Example Twig Template

Assumes that `entry` is defined by Craft and that all of the appropriate custom fields exist:

    {% if entry is defined %}
    
        {% set event = {
            'title': entry.title,
            'description': entry.description,
            'startDate': entry.startDate,
            'endDate': entry.endDate,
            'startTime': entry.startTime,
            'endTime': entry.endTime,
            'url': entry.url,
        } %}
    
        {{ craft.plainIcs.render(event) }}
    
    {% endif %}

