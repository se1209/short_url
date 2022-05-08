<?php
// Генерация короткого URI
// Решение найдено здесь
// https://www.youtube.com/watch?v=2oTFISdefXg
// Добавил возможность изменять длину урла
function short_uri_generate($length = 5) {
    $letters_nums = 'abcdefghijklmnoprstuvwxyz1234567890';
    $count = strlen($letters_nums);
    $intval = time();
    $result = '';
    for ($i=0; $i<$length; $i++) {
        $last = $intval % $count;
        $intval = ($intval-$last) / $count;
        $result .= $letters_nums[$last];
    }

    return $result;
}

// Проверяем URL
// Взял со старого проекта.
function is_url($url) {
    return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

// Сохраняем запрос там где одна ссылка
function save_one_url($id = NULL, $long_url, $tags, $title, $short_url) {

    $sql_insert_request = 'INSERT INTO urls (id, long_url, tags, title, short_url) VALUES (:id, :long_url, :tags, :title, :short_url)';

    $stmt = $pdo->prepare($sql_insert_request);

    $params = array(
        ':id'           => $id,
        ':long_url'     => $long_url,
        ':tags'         => $tags,
        ':title'        => $title,
        ':short_url'    => $short_url,
    );

    $result = $stmt->execute($params);

    if ($result) {
        $status_insert = true;
    } else {
        $status_insert = false;
    }

    return $status_insert;
}

// Ответ: сообщение об ошибке
function http_msg_responce($msg = 'some error') {
    return json_encode(array('Responce' => $msg));
}