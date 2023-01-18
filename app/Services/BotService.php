<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class BotService
{
    const SEND_MESSAGE = '/sendMessage';

    const COMMAND_START = '/start';

    private string $host;
    private string $token;
    private string $api;

    public $message;

    public string $type_bot_command = 'bot_command';

    public int $chat_id;
    public bool $is_bot = false;

    function __construct($message)
    {
        $this->message = $message->get('message');
        $this->api = env("TELEGRAM_API");
        $this->token = env("TOKEN");
        $this->host = $this->api . $this->token;

        $this->chat_id = $this->message['chat']['id'];

        if ($this->message['text'] == self::COMMAND_START && !$this->message['from']['is_bot']) {
            $this->sendMessage(self::SEND_MESSAGE, $this->getMessagesHello());
        }
    }

    public function methods()
    {

    }

    public function sendMessage($method, $text)
    {
        $client = new Client();
        $request = new Request('GET', $this->host . $method);
        return $client->send($request, [
            'query' => [
                'chat_id' => $this->chat_id,
                'text' => $text,
                'parse_mode' => 'html'
            ]
        ]);
    }

    public function getMessagesHello()
    {
        return 'Здравствуйте, чем помочь?';
    }
}
