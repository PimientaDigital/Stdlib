<?php

namespace Stdlib;

abstract class ArrayUtils
{
    public static function objectToArray($data)
    {
        if (is_array($data) || is_object($data)) {
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] = static::objectToArray($value);
            }

            return $result;
        }

        return $data;
    }

	public static function keysLowers($array)
	{
		$keys = array_keys($array);
		return array_map('strtolower', $keys);
	}

    public static function is_assoc($var)
    {
        return is_array($var) && array_diff_key($var,
                array_keys(array_keys($var)));
    }

    public static function is_sequential_array($var)
    {
        return (array_merge($var) === $var && is_numeric(implode(array_keys($var))) );
    }

    public static function merge(array $a, array $b, $preserveNumericKeys = false)
    {
        foreach ($b as $key => $value) {
            if (array_key_exists($key, $a)) {
                if (is_int($key) && !$preserveNumericKeys) {
                    $a[] = $value;
                } elseif (is_array($value) && is_array($a[$key])) {
                    $a[$key] = static::merge($a[$key], $value, $preserveNumericKeys);
                } else {
                    $a[$key] = $value;
                }
            } else {
                $a[$key] = $value;
            }
        }

        return $a;
    }

    public static function orderKeysByKeys(array $values,array $keys)
    {
        if (empty($keys)) {
            Throw new \Exception("La Variable keys no puede estar vacia");
        }

        $tmpArray = array();
        foreach ($keys as $key) {
            if (array_key_exists($key,$values)) {
                $tmpArray[$key] = $values[$key];
            }
        }

        return $tmpArray;
    }

    public static function is_assoc_array($var)
    {
        return (array_merge($var) !== $var || !is_numeric(implode(array_keys($var))) );
    }

    public static function isVector($var)
    {
        return count(array_diff_key($var, range(0, count($var) - 1))) == 0;
    }

    public static function isNullKeysArray($keys, $array)
    {
        foreach ($keys as $key) {
            if (!in_array($key, array_keys($array))) {
                return true;
            }
            if (!$array[$key]) {
                return true;
            }
        }

        return false;
    }

    public static function keys_exists_array($keys, $array)
    {
        foreach ($keys as $value) {
            if (!in_array($value, array_keys($array))) {
                return;
            }
        }

        return true;
    }

    public static function in_multiarray($elem, $array, $field)
    {
        foreach ($array as $key => $value) {
            if (!isset($value[$field])) {
                continue;
            }

            if ($value[$field] == $elem) {
                return true;
            } else {
                if(is_array($value[$field]))
                    if(static::in_multiarray($elem, ($value[$field])))

                        return true;
            }

        }

        return false;
    }

}
