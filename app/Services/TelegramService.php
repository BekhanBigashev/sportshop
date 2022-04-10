<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    private static $chatId = '785614296';
    private static $botToken = '1136049142:AAEQqxWkkViOIJNZNCsz9m4FPUp050Q9KiY';

    public static function newOrder($order)
    {
        $message = "Новый заказа на Sportshop.kz\n";
        $message .= "Имя: ".$order->name . "\n";
        $message .= "E-mail: " . $order->email . "\n";
        $message .= "Товары: \n";
        foreach ($order->products as $product) {
            $message .= $product->name . " X " . $product->pivot->count . "\n";
        }
        TelegramService::send($message);
    }
    public static function send(string $message)
    {
        $response = Http::get('https://api.telegram.org/bot' . self::$botToken . '/sendMessage?chat_id=' . self::$chatId . '&text=' . $message);
    }
}
