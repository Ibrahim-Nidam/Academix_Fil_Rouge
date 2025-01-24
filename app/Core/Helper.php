<?php

namespace Core;

class Helper
{
    public const BASE_URL = 'http://localhost/[20]%20Fil%20Rouge%20-%20Management%20system%20of%20a%20private%20school/Public/';

    public static function titleCase(string $string): string
    {
        return ucwords(strtolower($string));
    }

    public static function randomString(int $length = 16): string
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    public static function isAssocArray(array $array): bool
    {
        return array_keys($array) !== range(0, count($array) - 1);
    }

    public static function formatDate(string $date, string $format = 'Y-m-d H:i:s'): string
    {
        return date($format, strtotime($date));
    }

    public static function dateDiffInDays(string $date1, string $date2): int
    {
        $d1 = new \DateTime($date1);
        $d2 = new \DateTime($date2);
        return $d1->diff($d2)->days;
    }
}

?>
