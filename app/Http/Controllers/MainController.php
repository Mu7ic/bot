<?php

namespace App\Http\Controllers;


use App\Services\BotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
     * Единый точка входа для запросов
     *
     */
    public function main(Request $request)
    {
        Log::info($request->getContent());
        new BotService($request->request);
    }
}
