<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class PayBoxApiService
{
    public const MERCHANT_ID = '543847';
    public const MERCHANT_SECRET = 'iIL7ueVo0OWJzzY1';

    public const PAYMENT_PAGE = 'https://api.paybox.money/payment.php';
/*
    private $rg_order_id;
    private $amount;*/
    public static function getPaymentPageLink(Order $order)
    {
        $data = [
            'pg_order_id' => $order->id,
            'pg_merchant_id' => self::MERCHANT_ID,
            'pg_amount' => $order->totalPrice(),
            'pg_description' => 'Оплата заказа',
            'pg_salt' => 'some random string',
            'pg_success_url' => 'http::/localhost:8000/?payment_success=Y',
            'pg_failure_url' => 'http::/localhost:8000/?payment_success=N',
        ];
        $pgSig = self::makeSignature($data);
        $data['pg_sig'] = $pgSig;
        TelegramService::send(print_r($data, true));
        $response = Http::asForm()->post(self::PAYMENT_PAGE, $data);
        TelegramService::send(print_r($response, true));
        return $response;

    }
    private static function makeSignature(array $dataForSignature)
    {
        // Превращаем объект запроса в плоский массив
        $requestForSignature = self::makeFlatParamsArray($dataForSignature);

        // Генерация подписи
        ksort($requestForSignature); // Сортировка по ключю
        array_unshift($requestForSignature, 'init_payment.php'); // Добавление в начало имени скрипта
        array_push($requestForSignature, self::MERCHANT_SECRET); // Добавление в конец секретного ключа

        return md5(implode(';', $requestForSignature)); // Полученная подпись
    }

    private static function makeFlatParamsArray($arrParams, $parent_name = '')
    {
        $arrFlatParams = [];
        $i = 0;
        foreach ($arrParams as $key => $val) {
            $i++;
            /**
             * Имя делаем вида tag001subtag001
             * Чтобы можно было потом нормально отсортировать и вложенные узлы не запутались при сортировке
             */
            $name = $parent_name . $key . sprintf('%03d', $i);
            if (is_array($val)) {
                $arrFlatParams = array_merge($arrFlatParams, self::makeFlatParamsArray($val, $name));
                continue;
            }
    $arrFlatParams += array($name => (string)$val);
    }

    return $arrFlatParams;
    }
}

/*
array:6 [
  "pg_order_id" => 140
  "pg_merchant_id" => "543847"
  "pg_amount" => 1500.0
  "pg_description" => "Оплата заказа"
  "pg_salt" => "some random string"
  "pg_sig" => "e8d9885b6431b9bef3e29142dd6da8d0"
]*/
