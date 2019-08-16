<?php
include('vendor/autoload.php');
include('TelegramBot.php');
include('simple_html_dom.php');

// получить сообщение
$telegramApi = new TelegramBot();

while (true) {

    sleep(2);
    $updates = $telegramApi->getUpdates();
    print_r($updates);

    // пробежаьбся по каждому сообщению
    // отвечать на каждое сообщение
    foreach ($updates as $update) {
        $chatId = $update->message->chat->id;
        $msg = $update->message->text;
        if ($msg === '/start') {$text="Добро пожаловать!\nЧтобы узнать как пользоваться ботом используй команду /help";}
        elseif ($msg === '/help') {$text="Давай же вместе узнаем, что интересного ждет тебя сегодня)\n" .
            "Надеюсь, ты знаешь свой зодиакальный знак) В зависимости от этого введи одно из следующих слов:\n\n" .
            "aries - если ты Овен\n" .
            "taurus - если ты Телец\n" .
            "gemini - если ты Близнецы\n" .
            "cancer - если ты Рак\n" .
            "leo - если ты Лев\n" .
            "virgo - если ты Дева\n" .
            "libra - если ты Весы\n" .
            "scorpio - если ты Скорпион\n" .
            "sagittarius - если ты Стрелец\n" .
            "capricorn - если ты Козерог\n" .
            "aquarius - если ты Водолей\n" .
            "pisces - если ты Рыбы\n";}
        elseif ($msg === 'aries' || $msg === 'taurus' || $msg === 'gemini' || $msg === 'cancer' || $msg === 'leo' || $msg === 'virgo'
            || $msg === 'libra' || $msg === 'scorpio' || $msg === 'sagittarius' || $msg === 'capricorn' || $msg === 'aquarius' || $msg === 'pisces')
        {
            $websiteUrl = 'http://astroscope.ru/horoskop/ejednevniy_goroskop/' . $msg . '.html';
            $html = file_get_html($websiteUrl);
            foreach ($html->find('p[class=p-3]') as $find )
            {
//                print($find);
                $text = trim($find, "<p class=\"p-3\"> </p> \t\n\r\0\x0B");
//                $text = '44';
            }
        }
        else {$text='Пожалуйста, придерживайся инструкции ;) ';}
        $telegramApi->sendMessage($chatId, $text);
    }
}
?>
