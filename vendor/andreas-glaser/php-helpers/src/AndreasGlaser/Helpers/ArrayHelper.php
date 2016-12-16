<?php

namespace AndreasGlaser\Helpers;

use Exception;

/**
 * Class ArrayHelper
 *
 * @package Helpers
 *
 * @author  Andreas Glaser
 */
class ArrayHelper
{
    const PATH_DELIMITER = '.';

    /**
     * Returns value by key or a default value if it does not exist.
     *
     * @param array $array
     * @param       $key
     * @param null  $default
     *
     * @return null
     * @author Andreas Glaser
     */
    public static function get(array $array, $key, $default = null)
    {
        return array_key_exists($key, $array) ? $array[$key] : $default;
    }

    /**
     * Returns first array key with matching value.
     *
     * @param array $array
     * @param mixed $value
     * @param null  $default
     * @param bool  $strict
     *
     * @return mixed|null
     * @author Andreas Glaser
     */
    public static function getKeyByValue(array $array, $value, $default = null, $strict = true)
    {
        $key = array_search($value, $array, $strict);

        return $key !== false ? $key : $default;
    }

    /**
     * @param array  $array
     * @param        $path
     * @param bool   $throwException
     * @param null   $default
     * @param string $delimiter
     *
     * @return null
     * @author Andreas Glaser
     */
    public static function getByPath(array $array, $path, $throwException = false, $default = null, $delimiter = self::PATH_DELIMITER)
    {
        $pieces = explode($delimiter, $path);

        $value = $default;

        foreach ($pieces AS $piece) {
            if (array_key_exists($piece, $array)) {
                $value = $array[$piece];
                $array = $array[$piece];
            } else {
                if ($throwException) {
                    throw new \RuntimeException(sprintf('Array index "%s" does not exist', $piece));
                } else {
                    return $default;
                }
            }
        }

        return $value;
    }

    /**
     * @param array  $array
     * @param string $path
     * @param mixed  $value
     * @param string $delimiter
     *
     * @return array
     * @author Andreas Glaser
     */
    public static function setByPath(array $array, $path, $value, $delimiter = self::PATH_DELIMITER)
    {
        $current = &$array;
        $pathParts = explode($delimiter, $path);
        $partCount = count($pathParts);

        $i = 1;
        foreach ($pathParts AS $piece) {
            $isLast = $i === $partCount;

            if (array_key_exists($piece, $current)) {
                if ($isLast) {
                    $current[$piece] = $value;
                } else {
                    if (!is_array($current[$piece])) {
                        throw new \RuntimeException(
                            sprintf('Array index "%s" exists already and is not of type "array"', $piece)
                        );
                    }
                }
            } else {
                $current[$piece] = $isLast ? $value : [];
            }

            $current = &$current[$piece];
            $i++;
        }

        return $array;
    }

    /**
     * @param array  $array
     * @param        $path
     * @param string $delimiter
     *
     * @return bool
     * @author Andreas Glaser
     */
    public static function existsByPath(array $array, $path, $delimiter = self::PATH_DELIMITER)
    {
        $current = &$array;
        $pathParts = explode($delimiter, $path);

        foreach ($pathParts AS $pathPart) {
            if (is_array($current) && array_key_exists($pathPart, $current)) {
                $current = $current[$pathPart];
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array  $array
     * @param        $path
     * @param string $delimiter
     *
     * @return bool
     * @author Andreas Glaser
     */
    public static function issetByPath(array $array, $path, $delimiter = self::PATH_DELIMITER)
    {
        $current = &$array;
        $pathParts = explode($delimiter, $path);

        foreach ($pathParts AS $pathPart) {
            if (is_array($current) && isset($current[$pathPart])) {
                $current = $current[$pathPart];
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Adds index/value at the beginning of an array.
     *
     * @param array $array
     * @param       $value
     * @param mixed $key
     *
     * @return array
     * @author Andreas Glaser
     */
    public static function prepend(array $array, $value, $key = false)
    {
        $array = array_reverse($array, true);

        if ($key !== false) {
            $array[$key] = $value;
        } else {
            $array[] = $value;
        }

        return array_reverse($array, true);
    }

    /**
     * Adds index/value at the end of an array.
     *
     * @param array $array
     * @param       $value
     * @param mixed $key
     *
     * @return array
     * @author Andreas Glaser
     */
    public static function append(array $array, $value, $key = false)
    {
        if ($key !== false) {
            $array[$key] = $value;
        } else {
            $array[] = $value;
        }

        return $array;
    }

    /**
     * @param array $array
     * @param       $position
     * @param array $values
     *
     * @return array
     * @throws Exception
     */
    public static function insertBefore(array &$array, $position, array $values)
    {
        // enforce existing position
        if (!isset($array[$position])) {
            throw new Exception(strtr('Array position does not exist (:1)', [':1' => $position]));
        }

        // offset
        $offset = -1;

        // loop through array
        foreach ($array as $key => $value) {
            // increase offset
            ++$offset;

            // break if key has been found
            if ($key == $position) {
                break;
            }
        }

        return array_slice($array, 0, $offset, true) + $values + array_slice($array, $offset, null, true);
    }

    /**
     * @param array $array
     * @param       $position
     * @param array $values
     *
     * @return array
     * @throws Exception
     */
    public static function insertAfter(array &$array, $position, array $values)
    {
        // enforce existing position
        if (!isset($array[$position])) {
            throw new Exception(strtr('Array position does not exist (:1)', [':1' => $position]));
        }

        // offset
        $offset = 0;

        // loop through array
        foreach ($array as $key => $value) {
            // increase offset
            ++$offset;

            // break if key has been found
            if ($key == $position) {
                break;
            }
        }

        $array = array_slice($array, 0, $offset, true) + $values + array_slice($array, $offset, null, true);

        return $array;
    }

    /**
     * Returns the value of the first index of an array.
     *
     * @param array $array
     * @param mixed $default
     *
     * @return mixed
     * @author Andreas Glaser
     */
    public static function getFirstValue(array $array, $default = null)
    {
        $firstItem = reset($array);

        return $firstItem ? $firstItem : $default;
    }

    /**
     * Returns the value of the last index of an array.
     *
     * @param array $array
     * @param mixed $default
     *
     * @return mixed
     * @author Andreas Glaser
     */
    public static function getLastValue(array $array, $default = null)
    {
        $lastItem = end($array);

        return $lastItem ? $lastItem : $default;
    }

    /**
     * @param array $array
     *
     * @return mixed
     * @author Andreas Glaser
     */
    public static function getRandomValue(array $array)
    {
        return $array[array_rand($array)];
    }

    /**
     * Removes first element of an array without re-indexing.
     *
     * @param array $array
     *
     * @return array
     *
     * @author Andreas Glaser
     */
    public static function removeFirstIndex(array $array)
    {
        if (empty($array)) {
            return $array;
        }

        reset($array);
        unset($array[key($array)]);

        return $array;
    }

    /**
     * @param array $array
     * @param mixed $value
     * @param bool  $strict
     *
     * @return array
     * @author Andreas Glaser
     */
    public static function removeByValue(array $array, $value, $strict = true)
    {
        $key = array_search($value, $array, $strict);
        if ($key !== false) {
            unset($array[$key]);
        }

        return $array;
    }

    /**
     * Recursively converts array keys from camel case to underscore case.
     *
     * @param array $array
     *
     * @return array
     *
     * @author Andreas Glaser
     */
    public static function keysCamelToUnderscore(array $array)
    {
        $newArray = [];

        foreach ($array AS $key => $value) {

            if (!is_array($value)) {
                unset($array[$key]);
                $newArray[StringHelper::camelToUnderscore($key)] = $value;
            } else {
                unset($array[$key]);
                $newArray[StringHelper::camelToUnderscore($key)] = self::keysCamelToUnderscore($value);
            }
        }

        return $newArray;
    }

    /**
     * @param array $array
     * @param bool  $recursive
     *
     * @return array
     *
     * @author Andreas Glaser
     */
    public static function unsetEmptyValues(array $array, $recursive = false)
    {
        foreach ($array AS $key => $value) {
            if (empty($value)) {
                unset($array[$key]);
                continue;
            }

            if ($recursive === true && is_array($value)) {
                $array[$key] = self::unsetEmptyValues($value);
            }
        }

        return $array;
    }

    /**
     * @param       $glue
     * @param array $pieces
     *
     * @return string
     *
     * @author Andreas Glaser
     */
    public static function implodeIgnoreEmpty($glue, array $pieces)
    {
        $processedPieces = [];
        foreach ($pieces AS $piece) {
            if (!empty($piece)) {
                $processedPieces[] = $piece;
            }
        }

        return implode($glue, $processedPieces);
    }

    /**
     * Implodes array keys.
     *
     * @param       $glue
     * @param array $array
     *
     * @return string
     * @author Andreas Glaser
     */
    public static function implodeKeys($glue, array $array)
    {
        return implode($glue, array_keys($array));
    }

    /**
     * @param      $delimiter
     * @param      $string
     *
     * @return array
     * @author Andreas Glaser
     */
    public static function explodeIgnoreEmpty($delimiter, $string)
    {
        $return = [];
        $pieces = explode($delimiter, $string);
        foreach ($pieces AS $value) {
            if (!empty($value)) {
                $return[] = $value;
            }
        }

        return $return;
    }

    /**
     * @param array $array
     * @param bool  $recursive
     *
     * @return array
     *
     * @author Andreas Glaser
     */
    public static function valueToUpper(array $array, $recursive = true)
    {
        $return = [];

        foreach ($array AS $key => $value) {
            if ($recursive && is_array($value)) {
                $return[$key] = self::valueToUpper($value, $recursive);
            }

            $return[$key] = mb_strtoupper($value);
        }

        return $return;
    }

    /**
     * Checks if given array is associative.
     *
     * @param array $array
     *
     * @return bool
     *
     * @author Andreas Glaser
     */
    public static function isAssoc(array $array)
    {
        $keys = array_keys($array);

        return array_keys($keys) !== $keys;
    }

    /**
     * Checks if associative indexes in array1 existing in array2.
     * This is useful for the validation of configuration arrays.
     *
     * @param array $arrayToCheck
     * @param array $arrayToCompareWith
     * @param bool  $throwException
     *
     * @return bool
     *
     * @author Andreas Glaser
     */
    public static function assocIndexesExist(array $arrayToCheck, array $arrayToCompareWith, $throwException = true)
    {
        $exists = true;

        foreach ($arrayToCheck AS $key => $value) {
            if (self::isAssoc($arrayToCompareWith)) {
                if (!array_key_exists($key, $arrayToCompareWith)) {
                    if ($throwException) {
                        throw new \RuntimeException('Key does not exist (' . $key . ')');
                    } else {
                        $exists = false;
                    }
                } elseif (is_array($value)) {
                    if (!$exists = self::assocIndexesExist($value, $arrayToCompareWith[$key], $throwException)) {
                        return false;
                    }
                }
            }
        }

        return $exists;
    }

    /**
     * Replaces values of an array.
     *
     * @param array     $array
     * @param           $value
     * @param           $replacement
     * @param bool|true $recursively
     * @param bool|true $caseSensitive
     *
     * @return array
     * @author Andreas Glaser
     */
    public static function replaceValue(array $array, $value, $replacement, $recursively = true, $caseSensitive = true)
    {
        foreach ($array AS $k => $v) {
            if ($recursively && is_array($v)) {
                $array[$k] = self::replaceValue($array[$k], $value, $replacement, $recursively, $caseSensitive);
            } elseif (is_string($v) && StringHelper::is($v, $value, $caseSensitive)) {
                $array[$k] = $replacement;
            }
        }

        return $array;
    }

    /**
     * Merges multiple arrays
     *
     * @return array
     * @source https://api.drupal.org/api/drupal/includes!bootstrap.inc/function/drupal_array_merge_deep_array/7
     */
    public static function merge()
    {
        $arrays = func_get_args();

        $result = [];

        foreach ($arrays as $argumentIndex => $array) {

            if (!is_array($array)) {
                throw new \InvalidArgumentException(sprintf('Argument %d is not an array', $argumentIndex + 1));
            }

            foreach ($array as $key => $value) {
                if (is_integer($key)) {
                    $result[] = $value;
                } elseif (isset($result[$key]) && is_array($result[$key]) && is_array($value)) {
                    $result[$key] = static::merge($result[$key], $value);
                } else {
                    $result[$key] = $value;
                }
            }
        }

        return $result;
    }

    /**
     * @param array $array
     * @param null  $default
     *
     * @return mixed|null
     * @deprecated Please use ArrayHelper::getFirstValue($array, $default) instead.
     *
     * @author     Andreas Glaser
     */
    public static function getFirstIndex($array, $default = null)
    {
        return static::getFirstValue($array, $default);
    }

    /**
     * @param $array
     * @param $key
     * @param $val
     *
     * @return array
     *
     * @author     Andreas Glaser
     * @deprecated Use ArrayHelper::prepend() instead.
     */
    public static function unshiftAssoc($array, $key, $val)
    {
        return static::prepend($array, $val, $key);
    }
}

