<?php

return [
    'botToken' => env('TELEGRAM_BOT_TOKEN'),
    'chatId' => [
        'info' => env('TELEGRAM_CHAT_ID_INFO'),
        'warning' => env('TELEGRAM_CHAT_ID_WARNING'),
        'error' => env('TELEGRAM_CHAT_ID_ERROR'),
    ],
];
