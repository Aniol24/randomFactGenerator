<?php

function getTextApi(){

    $apiUrl = 'https://uselessfacts.jsph.pl/api/v2/facts/random?language=es';

    $ch = curl_init();


    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error al realizar la solicitud: ' . curl_error($ch);
    }


    curl_close($ch);

    $data = json_decode($response, true);


    if ($data === null) {
        return 'Error al decodificar el JSON';
    } else {
        return $data['text'];
    }
}
