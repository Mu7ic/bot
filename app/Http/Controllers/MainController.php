<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Единый точка входа для запросов от телеграм
     *
     */
    public function main()
    {
        $data = file_get_contents('php://input');

        Log::info( $data );
    }
}
