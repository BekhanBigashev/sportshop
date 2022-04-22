<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class B24Service
{
    public const BASE_API_URL = 'https://b24-tegk2q.bitrix24.kz/rest/1/';
    public const DEAL_ADD_ENDPOINT = 'jp75zi5ux5hcshzp/crm.deal.add.json';
    public const CONTACT_ADD_ENDPOINT = '61ix1g0q69s5lwbs/crm.deal.contact.add.json';

    public static function addDeal(array $data)
    {
        return self::execRest(self::DEAL_ADD_ENDPOINT, $data);
    }

    public static function addContact(array $data)
    {
        return self::execRest(self::CONTACT_ADD_ENDPOINT, $data);
    }
    private static function execRest($endpoint, $data) {

        $queryUrl = self::BASE_API_URL . $endpoint;
        $response = Http::asForm()->post($queryUrl, $data);
        Log::debug(print_r($response, true));
        return Response::json($response);
    }
}
