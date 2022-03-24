<?php
/**
 * @desc Str.php 描述信息
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/3/24 16:50
 */
declare(strict_types=1);


namespace Tinywan\Support;


use Composer\Pcre\Preg;
use Exception;

class Str
{
    /**
     * @desc: Generate a more truly "random" alpha-numeric string.
     * @param int $length
     * @return string
     * @throws Exception
     * @author Tinywan(ShaoBo Wan)
     */
    public static function random(int $length = 16): string
    {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;

            $bytes = random_bytes($size);

            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }

    /**
     * @desc: 将给定的字符串转换为大写
     * @param string $value
     * @return string
     * @author Tinywan(ShaoBo Wan)
     */
    public static function upper(string $value): string
    {
        return mb_strtoupper($value, 'UTF-8');
    }

    /**
     * 将给定的字符串转换为标题大小写
     */
    public static function title(string $value): string
    {
        return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * @desc: 返回由 start 和 length 参数指定的字符串部分。
     * @param string $string
     * @param int $start
     * @param int|null $length
     * @return string
     * @author Tinywan(ShaoBo Wan)
     */
    public static function substr(string $string, int $start, ?int $length = null): string
    {
        return mb_substr($string, $start, $length, 'UTF-8');
    }

    /**
     * @desc: 转换字符串的编码
     * @param string $string
     * @param string $to
     * @param string $from
     * @return string
     * @author Tinywan(ShaoBo Wan)
     */
    public static function encoding(string $string, string $to = 'utf-8', string $from = 'gb2312'): string
    {
        return mb_convert_encoding($string, $to, $from);
    }

    /**
     * @desc: 是否是手机号码
     * @param string $mobile
     * @return bool
     * @author Tinywan(ShaoBo Wan)
     */
    public static function isMobile(string $mobile): bool
    {
        return Preg::isMatch('/^1[3-9]\d{9}$/', $mobile);
    }

    /**
     * @desc: 是否是身份证号码
     * @param string $idcard
     * @return bool
     * @author Tinywan(ShaoBo Wan)
     */
    public static function isIdCard(string $idcard): bool
    {
        return Preg::isMatch('/(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}$)/', $idcard);
    }

    /**
     * @desc: 是否是邮箱格式
     * @param string $email
     * @return bool
     * @author Tinywan(ShaoBo Wan)
     */
    public static function isEmail(string $email): bool
    {
        return Preg::isMatch('/(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}$)/', $email);
    }

    /**
     * @desc: IP转换为地址
     * eg：39.170.63.237 => 浙江省杭州市西湖区 移动
     * @param string $ip
     * @return string
     * @throws Exception
     * @author Tinywan(ShaoBo Wan)
     */
    public static function ipToAddress(string $ip): string
    {
        $ip2region = new \Ip2Region();
        $ipInfo = $ip2region->btreeSearch($ip);
        $res = '未知';
        if(isset($ipInfo['region'])) {
            $tmp = explode('|',$ipInfo['region']);
            unset($tmp[0]);
            unset($tmp[1]);
            $res = implode('',$tmp);
        }
        return $res;
    }
}