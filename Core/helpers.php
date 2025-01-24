<?php

namespace App\Helpers;

class Helper
{
    // Base URL for the application
    public const BASE_URL = 'http://localhost/[20]%20Fil%20Rouge%20-%20Management%20system%20of%20a%20private%20school/Public/'; // Replace with your actual base URL

    // Format a string to title case
    

    // Generate a random string of specified length
    public static function randomString(int $length = 16): string
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); // Generates a random alphanumeric string
    }

    // Check if an array is associative
    public static function isAssocArray(array $array): bool
    {
        return array_keys($array) !== range(0, count($array) - 1); // Checks if keys are not sequential numeric indices
    }

    // Format a date to a specified format
    public static function formatDate(string $date, string $format = 'Y-m-d H:i:s'): string
    {
        return date($format, strtotime($date)); // Converts a date string to the specified format
    }

    // Sanitize a string for safe output
    public static function sanitizeString(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8'); // Escapes special characters for HTML output
    }

    // Calculate the difference in days between two dates
    public static function dateDiffInDays(string $date1, string $date2): int
    {
        $d1 = new \DateTime($date1);
        $d2 = new \DateTime($date2);
        return $d1->diff($d2)->days; // Returns the absolute difference in days between two dates
    }

    // Validate an email address
    public static function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false; // Checks if the email address is valid
    }

    // Convert bytes to a human-readable size
    public static function bytesToHumanReadable(int $bytes): string
    {
        $sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.2f %s", $bytes / pow(1024, $factor), $sizes[$factor]); // Converts bytes into a readable size format
    }

    // Generate a slug from a string
    public static function generateSlug(string $string): string
    {
        $string = preg_replace('/[^a-zA-Z0-9-]/', '-', strtolower(trim($string))); // Replaces non-alphanumeric characters with hyphens
        return preg_replace('/-+/', '-', $string); // Removes consecutive hyphens
    }

    // Get the client's IP address
    public static function getClientIp(): string
    {
        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0'; // Retrieves the client's IP address or a default value
    }

    // Paginate an array
    public static function paginateArray(array $items, int $perPage, int $currentPage = 1): array
    {
        $offset = ($currentPage - 1) * $perPage;
        return array_slice($items, $offset, $perPage); // Returns a subset of the array based on pagination
    }

    // Convert a JSON string to an array safely
    public static function jsonToArray(string $json): array
    {
        $result = json_decode($json, true);
        return $result === null ? [] : $result; // Safely decodes JSON into an array, returning an empty array on failure
    }

    // Encrypt a string using a simple method
    public static function encryptString(string $string, string $key): string
    {
        return base64_encode(openssl_encrypt($string, 'AES-128-ECB', $key)); // Encrypts a string using AES-128-ECB
    }

    // Decrypt a string using a simple method
    public static function decryptString(string $encrypted, string $key): string
    {
        return openssl_decrypt(base64_decode($encrypted), 'AES-128-ECB', $key); // Decrypts a string using AES-128-ECB
    }

    // Debugging: Dump a value and stop execution
    public static function dd($value): void
    {
        echo "<pre>";
        var_dump($value); // Dumps the value
        echo "</pre>";
        die(); // Halts execution
    }

    // Debugging: Dump a value without stopping execution
    public static function dump($value): void
    {
        echo "<pre>";
        var_dump($value); // Dumps the value
        echo "</pre>";
    }

    // Debugging: Pretty print an array or object
    public static function prettyPrint($value): void
    {
        echo "<pre>" . print_r($value, true) . "</pre>"; // Formats and prints human-readable output
    }
}

?>
