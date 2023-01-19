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

    function __construct($message)
    {
        $this->message = $message->get('message');
        $this->api = env("TELEGRAM_API");
        $this->token = env("TOKEN");
        $this->host = $this->api . $this->token;

        $this->chat_id = $this->message['chat']['id'];

        if ($this->message['text'] == self::COMMAND_START && !$this->message['from']['is_bot']) {
            $this->sendMessage(self::SEND_MESSAGE, $this->getMessagesHello(),'go');
        }
    }

    public function methods()
    {

    }

    public function sendMessage($method, $text, $rely_markup = null)
    {
        $client = new Client();
        $request = new Request('GET', $this->host . $method);

        $data = [
            'query' => [
                'chat_id' => $this->chat_id,
                'text' => $text,
            ]
        ];

        if ($rely_markup) {
            $data["query"]["reply_markup"] = json_encode([
                'inline_keyboard' => [
                    [
                        [
                            'text' => 'Авторизоваться',
                            'callback_data' => 'auth',
                        ],
                        [
                            'text' => 'Какая помощь вам нужна?',
                            'callback_data' => 'questions',
                        ],
                    ]
                ],
            ]);
        }

        return $client->send($request, $data);
    }

    public function getMessagesHello()
    {
        return 'Здравствуйте, чем помочь?';
    }
}
