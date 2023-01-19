<?php

namespace App\Http\Controllers;


use App\Services\BotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
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
