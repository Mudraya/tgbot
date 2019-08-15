<?php
include('vendor/autoload.php');
include('TelegramBot.php');

// получить сообщение
$telegramApi = new TelegramBot();

while (true) {

    sleep(2);
    $updates = $telegramApi->getUpdates();
    print_r($updates);

    // пробежаьбся по каждому сообщению
    foreach ($updates as $update) {
        $telegramApi->sendMessage($update->message->chat->id, 'Hello');
    }
}

// отвечать на каждое сообщение
?>
