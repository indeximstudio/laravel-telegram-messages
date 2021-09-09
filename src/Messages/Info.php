<?php

namespace Indeximstudio\LaravelTelegramMessages\Messages;


use Illuminate\Support\Arr;
use Illuminate\View\View;
use Throwable;

class Info extends Message
{
    /**
     * @param $text
     * @param array $params
     * @return static
     * @throws Throwable
     */
    public static function make($text, $params = []): Info
    {
        return new static($text, $params);
    }

    /**
     * @param View|array|string $text
     * @param array $params
     * @throws Throwable
     */
    public function __construct($text = '', $params = []) {
        parent::__construct(
            config('laravel-telegram-messages.chatId.info'),
            $this->prepareText($text),
            Arr::get($params, 'parse_mode'),
            Arr::get($params, 'disable_web_page_preview'),
            Arr::get($params, 'disable_notification'),
            Arr::get($params, 'reply_to_message_id'),
            Arr::get($params, 'reply_markup')
        );

        \Log::info($this->text);
    }
}
