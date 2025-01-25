<?php
/*
 * Copyright © 2024 Ibrahim Nidam
 * All rights reserved.
 * Unauthorized use of this file, via any medium, is strictly prohibited.
 */

namespace Core;

class Helper
{
    public const BASE_URL = 'http://localhost/[20]%20Fil%20Rouge%20-%20Management%20system%20of%20a%20private%20school/Public/';

    public static function titleCase(string $string): string {
        return ucwords(strtolower($string));
    }

    public static function randomString(int $length = 16): string {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    public static function isAssocArray(array $array): bool {
        return array_keys($array) !== range(0, count($array) - 1);
    }

    public static function formatDate(string $date, string $format = 'Y-m-d H:i:s'): string {
        return date($format, strtotime($date));
    }

    public static function dateDiffInDays(string $date1, string $date2): int {
        $d1 = new \DateTime($date1);
        $d2 = new \DateTime($date2);
        return $d1->diff($d2)->days;
    }

    public static function bytesToHumanReadable(int $bytes): string {
        $sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.2f %s", $bytes / pow(1024, $factor), $sizes[$factor]);
    }

    public static function generateSlug(string $string): string {
        $string = preg_replace('/[^a-zA-Z0-9-]/', '-', strtolower(trim($string)));
        return preg_replace('/-+/', '-', $string);
    }

    public static function paginateArray(array $items, int $perPage, int $currentPage = 1): array {
        $offset = ($currentPage - 1) * $perPage;
        return array_slice($items, $offset, $perPage);
    }

    public static function jsonToArray(string $json): array {
        $result = json_decode($json, true);
        return $result === null ? [] : $result;
    }

    public static function encryptString(string $string, string $key): string {
        return base64_encode(openssl_encrypt($string, 'AES-128-ECB', $key));
    }

    public static function decryptString(string $encrypted, string $key): string {
        return openssl_decrypt(base64_decode($encrypted), 'AES-128-ECB', $key);
    }

    public static function dd($value): void {
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
        die();
    }

    public static function dump($value): void {
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
    }

    public static function prettyPrint($value): void {
        echo "<pre>" . print_r($value, true) . "</pre>";
    }
}