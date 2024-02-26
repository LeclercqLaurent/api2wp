<?php

namespace App\Service;

class Api
{
    private static string $api_url = 'https://api.example.com/';

    public static function get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    public static function getApiUrl(): string
    {
        return self::$api_url;
    }
}
