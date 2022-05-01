<?php
// Генерация короткого URI
// Решение найдено здесь
// https://www.youtube.com/watch?v=2oTFISdefXg
function short_uri_generate() {
    $letters_nums = 'abcdefghijklmnoprstuvwxyz1234567890';
    $count = strlen($letters_nums);
    $intval = time();
    $result = '';
    for ($i=0; $i<5; $i++) {
        $last = $intval % $count;
        $intval = ($intval-$last) / $count;
        $result .= $letters_nums[$last];
    }

    return $result;
}

// Проверяем URL
// Взял со старого проекта.
function is_url($url) {
    $true_false_url = preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
    return $true_false_url;
}

// Сохраняем запрос там где одна ссылка
function saveOneUrl() {
    global $pdo;

    var_dump($pdo);

    // Debug
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = NULL;
    $long_url = 'https://google.com';
    $tags = 'homepage, mylink';
    $title = 'Cool link to google';
    $short_url = short_uri_generate();

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