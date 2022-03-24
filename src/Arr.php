<?php
/**
 * @desc Arr.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/3/24 17:08
 */
declare(strict_types=1);


namespace Tinywan\Support;


class Arr
{
    /**
     * @desc: 将一个数组分成两个数组。一个带键，另一个带值。
     * @param array $array
     * @return array
     * @author Tinywan(ShaoBo Wan)
     * @example
     * <pre>
     * // Input:
        $arr = [
            'id'  => 2022,
            'name'  => 'Tinywan'
        ];
     * // Output:
        array(2) {
            [0] =>
            array(3) {
            [0] =>
            string(2) "id"
            [1] =>
            string(4) "name"
        }
        [1] =>
            array(3) {
            [0] =>
            int(2022)
            [1] =>
            string(7) "Tinywan"
            }
        }
     * </pre>
     */
    public static function divide(array $array): array
    {
        return [array_keys($array), array_values($array)];
    }

    /**
     * @desc: 确定给定的键是否存在于提供的数组中。
     * @param array $array
     * @param $key
     * @return bool
     * @author Tinywan(ShaoBo Wan)
     */
    public static function exists(array $array, $key): bool
    {
        if ($array instanceof \ArrayAccess) {
            return $array->offsetExists($key);
        }

        return array_key_exists($key, $array);
    }

    /**
     * @desc: 获取数组中某个键名的所有的键值
     * @param array $array 数组
     * @param string $row 键名
     * @return array
     */
    public static function getRowsByArray(array $array, string $row)
    {
        $result = array();
        foreach ($array as $k => $value) {
            $result[] = $value[$row];
        }
        return $result;
    }

    /**
     * @desc: 以数组中某个键名作为数组的键名得到新的数组
     * @param array $array
     * @param string $row
     * @return array
     * @author Tinywan(ShaoBo Wan)
     */
    public static function getArraByRows(array $array, string $row)
    {
        $result = array();
        foreach ($array as $k => $value) {
            $result[$value[$row]] = $value;
        }
        return $result;
    }

    /**
     * @desc: 以数组中的两个键值分别作为数组的键名，键值得到新的数组
     * @param array $array
     * @param string $key1
     * @param string $key2
     * @return array
     * @author Tinywan(ShaoBo Wan)
     */
    public static function get_array_by_key(array $array, string $key1, string $key2):array
    {
        $result = array();
        foreach ($array as $k => $value) {
            $result[$value[$key1]] = $value[$key2];
        }
        return $result;
    }
}