<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class MainController extends Controller
{
    public $domainTelegram;
    public $token;
    public $host;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->domainTelegram = env('TELEGRAM_API').env('TOKEN').'/';
        $this->token = env('TOKEN');
        $this->host = env('HOST').'v1/';
    }

    public function setWebhook()
    {
        $client = new Client(['base_uri' => $this->domainTelegram]);
        $response = $client->get("setWebhook?url={$this->host}");
        return response()->json($response->getBody());
    }
}
