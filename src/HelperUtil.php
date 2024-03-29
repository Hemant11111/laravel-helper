<?php
/**
 * User: Hemant Saini
 * Date: Mon, 15 Jul 2019 10:07:41 +0000
 */


namespace Devslane;


use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * Class HelperUtil
 * @package Devslane
 */
class HelperUtil
{
    /**
     * Generates a unique string of given length
     *
     * @param int $length
     * @param bool $caseSensitive
     * @param string $start
     * @return string
     */
    public static function generateUniqueId($length = 9, $caseSensitive = false, $start = '') {
        $startLength = strlen($start);

        $randomString = Str::random($length - $startLength);

        if (!$caseSensitive) {
            $randomString = strtolower($randomString);
        }

        return $start . $randomString;
    }

    /**
     * Generates a unique pin of given length
     *
     * @param int $digits
     * @return string
     */
    public static function generatePin($digits = 6) {
        $pin = "";
        for ($i = 0; $i < $digits; $i++) {
            $pin .= mt_rand(0, 9);
        }

        return $pin;
    }

    /**
     * Returns whether $value is associative array
     *
     * @param $value
     * @return bool
     */
    public static function isAssociativeArray($value) {
        if (!is_array($value)) {
            return false;
        }

        return array_keys($value) !== range(0, count($value) - 1);
    }

    /**
     * Returns whether $value is sequential array
     *
     * @param $value
     * @return bool
     */
    public static function isSequentialArray($value) {
        if (!is_array($value)) {
            return false;
        }

        return array_keys($value) === range(0, count($value) - 1);
    }

    /**
     * Returns whether passed string
     * is a valid timezone or not
     *
     * @param string $timezone
     * @return bool
     */
    public static function isTimezone($timezone) {
        return in_array($timezone, array_merge(timezone_identifiers_list(), [
            // Add missing timezones here
            'Asia/Calcutta'
        ]));
    }

    /**
     * Return null or casted string
     *
     * @param $value
     * @return string|null
     */
    public static function nullOrString($value) {
        return (strlen(trim($value)) > 0) ? $value : null;
    }

    /**
     * Return null or casted int
     *
     * @param $value
     * @return int|null
     */
    public static function nullOrInteger($value) {
        return ($value === null) ? null : (integer)$value;
    }

    /**
     * Return null or casted double
     *
     * @param $value
     * @return double|null
     */
    public static function nullOrDouble($value) {
        return ($value === null) ? null : (double)$value;
    }

    /**
     * Return null or casted bool
     *
     * @param $value
     * @return bool|null
     */
    public static function nullOrBool($value) {
        return ($value === null) ? null : (bool)$value;
    }

    /**
     * Return null or string
     *
     * @param $value
     * @return null|string
     */
    public static function nullOrDateTimeString($value) {
        if (!$value instanceof Carbon && !is_null($value)) {
            $value = Carbon::parse($value);
        }

        return is_null($value) ? null : $value->toDateTimeString();
    }

    /**
     * @param $value
     * @return string|null
     */
    public static function nullOrDateString($value) {
        if (!$value instanceof Carbon && !is_null($value)) {
            $value = Carbon::parse($value);
        }

        return is_null($value) ? null : $value->toDateString();
    }

    /**
     * Casts to string or returns $default
     * if $value passed is not string.
     *
     * @param $value
     * @param string $default
     * @return string|null
     */
    public static function castString($value, $default) {
        return is_string($value) ? (string)$value : $default;
    }

    /**
     * Casts to int or returns $default
     * if $value passed is not int.
     *
     * @param $value
     * @param int $default
     * @return int|null
     */
    public static function castInteger($value, $default) {
        return is_int($value) ? (integer)$value : $default;
    }

    /**
     * Casts to double or returns $default
     * if $value passed is not double.
     *
     * @param $value
     * @param double $default
     * @return double|null
     */
    public static function castDouble($value, $default) {
        return is_double($value) ? (double)$value : $default;
    }

    /**
     * Casts to bool or returns $default
     * if $value passed is not bool.
     *
     * @param $value
     * @param bool $default
     * @return bool|null
     */
    public static function castBool($value, $default) {
        return is_double($value) ? (bool)$value : $default;
    }

    /**
     * Returns if value is null or zero
     *
     * @param int|null $value
     * @return bool
     */
    public static function isNullOrZero($value) {
        if (is_null($value)) {
            return true;
        }

        return (integer)$value === 0;
    }

    /**
     * Returns if value is null or empty String
     *
     * @param string|null $value
     * @return bool
     */
    public static function isNullOrEmpty($value) {
        if (is_null($value)) {
            return true;
        }

        return $value === "";
    }

    /**
     * Round off $number
     *
     * @param $number
     * @param int $decimalPlaces
     * @return float
     */
    public static function roundOff($number, $decimalPlaces = 2) {
        return (float)number_format((float)$number, $decimalPlaces, '.', '');
    }

    /**
     * adds 0 prefix to complete length
     *
     * @param int $number
     * @param int $length
     * @param string $prefix
     * @return string
     */
    public static function formatInt($number, $length, $prefix = "0") {
        $stringNumber = "" . $number;

        $prefixLength = $length - strlen($stringNumber);

        $stringPrefix = "";

        for ($k = 0; $k < $prefixLength; $k++) {
            $stringPrefix .= $prefix;
        }

        return $stringPrefix . $stringNumber;
    }

    /**
     * Returns the lesser value
     * among $value and $limit
     *
     * @param int $value
     * @param int $limit
     * @return int
     */
    public static function trimValue($value, $limit = 100) {
        return $value < $limit ? $value : $limit;
    }

    /**
     * Trims the length of string
     * among $value and $limit
     *
     * @param string $value
     * @param int $length
     * @param string $delimiter
     * @return int
     */
    public static function trimLength($value, $length = 99, $delimiter = '...') {
        $actualLength = strlen($value);

        $output = $value;

        if ($actualLength > $length) {
            $delLength = strlen($delimiter);
            $output    = substr($value, 0, $length - $delLength);
            $output    = $output . $delimiter;
        }

        return $output;
    }

    /**
     * Checks if $needle exists in $haystack
     *
     * @param string $hayStack
     * @param string $needle
     * @param bool $caseSensitive
     * @return bool
     */
    public static function hasSubString($hayStack, $needle, $caseSensitive = false) {
        $_haystack = $hayStack;
        $_needle   = $needle;

        if (!$caseSensitive) {
            $_haystack = strtolower($hayStack);
            $_needle   = strtolower($needle);
        }

        return strpos($_haystack, $_needle) !== false;
    }

    /**
     * Masks the given string
     *
     * @param string $value
     * @param int $start
     * @param null $maskingLength
     * @param string $maskingCharacter
     * @return string
     */
    public static function mask($value, $start = 2, $maskingLength = null, $maskingCharacter = '*') {
        if (is_null($maskingLength)) {
            $defaultLength = strlen($value) - 6;

            if ($defaultLength <= 0) {
                $length = strlen($value) - 2;
            } else {
                $length = $defaultLength;
            }
        }

        return substr($value, 0, $start) . str_repeat($maskingCharacter, $length) . substr($value, ($start + $length));
    }


    /**
     * Generates Date Range from given start & end date
     *
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @param bool $inclusiveEnd
     * @param bool $inCarbon
     * @return array
     */
    public static function generateDateRange(Carbon $startDate, Carbon $endDate, $inclusiveEnd = true, $inCarbon = false) {
        $_start = $startDate->copy();
        $_end   = $endDate->copy();

        $dates = [];

        for ($date = $_start->copy(); $date->lt($_end); $date->addDay()) {
            if ($inCarbon) {
                $dates[] = $date->copy();
            } else {
                $dates[] = $date->format('Y-m-d');
            }
        }

        if ($inclusiveEnd) {
            if ($inCarbon) {
                $dates[] = $date->copy();
            } else {
                $dates[] = $date->format('Y-m-d');
            }
        }

        return $dates;
    }

    /**
     * Formats time to 12 hour format
     *
     * @param $time
     * @return string
     */
    public static function formatTime12HR($time) {
        if (!$time || !is_string($time)) {
            return $time;
        }
        $components = explode(":", $time);
        $hour       = (int)$components[0];
        $minutes    = (int)$components[1];

        $isPM = (int)$hour >= 12;

        $newHour = $isPM ? $hour - 12 : $hour;
        $suffix  = $isPM ? "PM" : "AM";

        return HelperUtil::formatInt($newHour, 2) . ":" . HelperUtil::formatInt($minutes, 2) . " " . $suffix;
    }


    /**
     * @param $firstName
     * @param string $lastName
     * @return string
     */
    public static function getFullName($firstName, $lastName = "") {
        return $lastName === "" ? $firstName : $firstName . ' ' . $lastName;
    }


    const OS_UNKNOWN = 1;
    const OS_WIN     = 2;
    const OS_LINUX   = 3;
    const OS_OSX     = 4;

    /**
     * @return int
     *
     * Get the Env Os..
     */
    public static function getOS() {
        switch (true) {
            case stristr(PHP_OS, 'DAR'):
                return self::OS_OSX;
            case stristr(PHP_OS, 'WIN'):
                return self::OS_WIN;
            case stristr(PHP_OS, 'LINUX'):
                return self::OS_LINUX;
            default :
                return self::OS_UNKNOWN;
        }
    }

    /**
     * @param $cmd
     * @return array
     *
     * returns full output and error logs.
     */
    public static function exec($cmd) {

        $proc = proc_open($cmd,
            array(
                0 => array('pipe', 'r'),
                1 => array('pipe', 'w'),
                2 => array('pipe', 'w')
            ), $pipes);

        fwrite($pipes[0], '');
        fclose($pipes[0]);

        $stdout = stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[2]);

        $rtn = proc_close($proc);

        return array(
            'stdout' => $stdout,
            'stderr' => $stderr,
            'return' => $rtn
        );
    }

    public static function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }


}
