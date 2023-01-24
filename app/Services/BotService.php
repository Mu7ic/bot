<?php

namespace App\Services;

use App\Models\Messages;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class BotService
{
    const SEND_MESSAGE = '/sendMessage';

    const COMMAND_START = '/start';

    private string $host;
    private string $token;
    private string $api;

    public $message, $callback;

    public int $chat_id;

    function __construct($message)
    {
        $this->message = $message->get('message') ?? $message->get('callback_query')['message'];

        $this->callback = $message->get('callback_query');

        $this->api = env("TELEGRAM_API");
        $this->token = env("TOKEN");
        $this->host = $this->api . $this->token;

        $this->chat_id = $this->message['chat']['id'];

        if (isset($this->message)) {
            if ($this->message['text'] == self::COMMAND_START && !$this->message['from']['is_bot']) {
                $this->sendMessage(self::SEND_MESSAGE, Messages::getMessage(Messages::HELLO), 'go');
            }
        }
        if (isset($this->callback)) {
            $this->chat_id = $this->callback['message']['chat']['id'];
            $this->sendMessage(self::SEND_MESSAGE, Messages::getMessage(Messages::AUTH));
        }
    }

    public function methods()
    {

    }

    /**
     * Отправка сообщений
     *
     * @param $method
     * @param $text
     * @param null $rely_markup
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMessage($method, $text, $rely_markup = null): \Psr\Http\Message\ResponseInterface
    {
        $client = new Client();
        $request = new Request('GET', $this->host . $method);

        $data = [
            'query' => [
                'chat_id' => $this->chat_id,
                'text' => $text,
                'parse_mode' => 'Markdown'
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
}
