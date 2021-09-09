<?php

namespace Indeximstudio\LaravelTelegramMessages\Messages;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\View\View;

class Message implements Arrayable
{
    public string $chat_id;
    public string $text;
    public string $parse_mode;
    public string $disable_web_page_preview;
    public string $disable_notification;
    public string $reply_to_message_id;
    public string $reply_markup;

    public function __construct(
        $chat_id,
        $text,
        $parse_mode = null,
        $disable_web_page_preview = null,
        $disable_notification = null,
        $reply_to_message_id = null,
        $reply_markup = null
    ) {
        $this->chat_id = $chat_id;
        $this->text = $text;
        $this->parse_mode = $parse_mode ?? 'html';
        $this->disable_web_page_preview = $disable_web_page_preview ?? '';
        $this->disable_notification = $disable_notification ?? '';
        $this->reply_to_message_id = $reply_to_message_id ?? '';
        $this->reply_markup = $reply_markup ?? '';
    }

    public function toArray(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'text' => $this->text,
            'parse_mode' => $this->parse_mode,
            'disable_web_page_preview' => $this->disable_web_page_preview,
            'disable_notification' => $this->disable_notification,
            'reply_to_message_id' => $this->reply_to_message_id,
            'reply_markup' => $this->reply_markup,
        ];
    }

    protected function prepareText($text): string
    {
        if ($text instanceof View) {
            return $this->prepareView($text);
        } elseif (is_array($text)) {
            return $this->prepareArray($text);
        } else {
            return $this->prepareString($text);
        }
    }

    protected function prepareView(View $text): string
    {
        $text = $text->render();
        return mb_strimwidth($text, 0, 4000);
    }

    protected function prepareArray(array $text): string
    {
        if (is_array($text['text'] ?? '')) {
            $text['text'] = print_r($text['text'], true);
            $text['text'] = mb_strimwidth($text['text'], 0, 4000);
            $text['text'] = "<pre>{$text['text']}</pre>";
        }
        return view($this->defaultViewName(), $text)->render();
    }

    protected function prepareString($text): string
    {
        return (string) $text;
    }

    protected function defaultViewName(): string
    {
        return 'telegram-messages:info';
    }
}
