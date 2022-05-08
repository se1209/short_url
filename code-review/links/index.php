<?php
/**
 * Привет!
 * Весь тот ужас, который вы будете далее проверять писался как некий компромис.
 * 1. Я никогда ранее не делал HTTP-сервис, потратил 2-3 дня на вход в тему, да Карл, 2-3 дня)
 * 2. Далее пошел гуглёж темы ссылкосокрщателя.
 * 3. Далее принятие решения писать в процедурке т.к., чего греха таить, не силён в ООП.
 *    Я понимаю, что писать это всё в процедурке треш в 2022 году, но пусть лучше так, чем совсем ничего.
 * 4. Так же не силён в теме, когда нужно написать с нуля.
 *    Если что-то готово там ещё доку покурить можно и в ООП пописать.
 * 5. Подытоживая, написал не всё, но что писал так сказать по честному, что в голове.
 * P.S. Из-за нехватки времени валидацию тоже опустил.
 */

require_once '../connect.php';
require_once '../functions.php';

// Данные из http запроса в виде массива
$arr_http_request_data = json_decode(file_get_contents('php://input'), true);

if (!empty($arr_http_request_data)) {

    // Минимальная валидация
    // Проверка, что нам передали URL
    if (is_url($arr_http_request_data['long_url']))
    {
        $clean_url = htmlentities($arr_http_request_data['long_url']);

        // Генерируем URI для короткой ссылки и вставляем все данные в БД
        $short_uri = short_uri_generate();

        $id = NULL;
        $long_url = 'https://google.com';
        $tags = 'homepage, mylink';
        $title = 'Cool link to google';

        save_one_url($id, $long_url, $tags, $title, $short_uri);

       /*
        * Сохранение в БД не происходит.
        * Ошибка: Uncaught exception 'PDOException' with message 'SQLSTATE[3D000]: Invalid catalog name: 1046 No database selected
        * Победить не смог.
        * Заливаю в нерабочем виде т.к. что-то нужно показать.
        */
    } else {
        echo http_msg_responce('Url isn\'t correctly');
    }
} else {
    // ?
}

// Закрываем соединение с БД
//$pdo = null;