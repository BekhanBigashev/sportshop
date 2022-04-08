<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    private static $chatId = '785614296';
    private static $botToken = '1136049142:AAEQqxWkkViOIJNZNCsz9m4FPUp050Q9KiY';
    public static function send(string $message)
    {
        $response = Http::get('https://api.telegram.org/bot' . self::$botToken . '/sendMessage?chat_id=' . self::$chatId . '&text=' . $message);
    }
}
