<?php namespace DigitalCanvas\Options;

/**
 * States Options Class
 *
 * @package    Options
 */
class States
{
    /**
     * xml data file
     * @var string
     */
    private static $file = null;

    /**
     * States data
     * @var array
     */
    private static $states = null;

    /**
     * Sets the xml file to use to load states
     *
     * @param string $file
     *
     * @return void
     */
    public static function setXML($file = null)
    {
        if (is_null($file)) {
            $file = __DIR__ . '/states.xml';
        }
        if (!is_file($file)) {
            throw new \RuntimeException('States XML file does not exist.');
        }
        self::$file = realpath($file);
        self::$states = null;
    }

    /**
     * Loads the states from the xml file.
     *
     * @return void
     */
    private static function loadStates()
    {
        if (is_null(self::$file)) {
            self::setXML();
        }
        // Load xml file
        $xml = simplexml_load_file(self::$file);
        $states = array();
        // loop through states
        foreach ($xml as $state) {
            $states[] = array(
                'abbreviation' => (string)$state->abbreviation,
                'name'         => (string)$state->name,
                'country'      => (string)$state->country,
                'countryname'  => (string)$state->countryname
            );
        }
        // Cache states
        self::$states = $states;
        // Clear xml instance
        unset($xml, $states, $state);
    }

    /**
     * Clears the states from the cache.
     *
     * @return void
     */
    public static function clearCache()
    {
        self::$states = null;
    }

    /**
     * Checks if data has been cached
     *
     * @return bool
     */
    public static function isCached()
    {
        return !is_null(self::$states);
    }

    /**
     * Returns array of states
     *
     * @param array $allowed_countries Array of allowed countries.<br> If null all are returned.
     *
     * @return array
     */
    public static function getArray($allowed_countries = array('US'))
    {
        // Load States if they are not yet loaded.
        if (is_null(self::$states)) {
            self::loadStates();
        }
        $states = self::$states;
        foreach ($states as $key => $value) {
            if ($allowed_countries && !in_array($value['country'], $allowed_countries)) {
                unset($states[$key]);
            }
        }
        return $states;
    }

    /**
     * Returns states as key=>value pair array
     *
     * @param array $allowed_countries Array of allowed countries.<br> If null all are returned.
     *
     * @return array
     */
    public static function getPairs($allowed_countries = array('US'))
    {
        // Load States if they are not yet loaded.
        if (is_null(self::$states)) {
            self::loadStates();
        }
        $states = array();
        foreach (self::$states as $state) {
            if (!$allowed_countries || in_array($state['country'], $allowed_countries)) {
                $states[$state['abbreviation']] = $state['name'];
            }
        }
        return $states;
    }

    /**
     * Returns states as key=>value pair array grouped by country
     *
     * @param array $allowed_countries Array of allowed countries.<br> If null all are returned.
     *
     * @return array
     */
    public static function getMultiPairs($allowed_countries = array('US', 'CA'))
    {
        // Load States if they are not yet loaded.
        if (is_null(self::$states)) {
            self::loadStates();
        }
        $states = array();
        foreach (self::$states as $state) {
            if (!$allowed_countries || in_array($state['country'], $allowed_countries)) {
                if (!array_key_exists($state['countryname'], $states)) {
                    $states[$state['countryname']] = array();
                }
                $states[$state['countryname']][$state['abbreviation']] = $state['name'];
            }
        }
        return $states;
    }

    /**
     * Returns a single state by abbreviation
     *
     * @param string $abbreviation
     * @param string $country
     * @param bool   $name_only
     *
     * @return string|array
     */
    public static function getState($abbreviation, $country = null, $name_only = true)
    {
        // Load States if they are not yet loaded.
        if (is_null(self::$states)) {
            self::loadStates();
        }
        foreach (self::$states as $state) {
            if ($abbreviation == $state['abbreviation'] && (!$country || $country == $state['country'])) {
                return ($name_only) ? $state['name'] : $state;
            }
        }
        return false;
    }
}
