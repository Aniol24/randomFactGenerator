<?php

    include_once("missatge.php");
    include_once ("apiCall.php");

    $factRequests = [
        "Give me an interesting fact!",
        "Tell me something fascinating!",
        "I'd love to learn a new fact!",
        "How about sharing some trivia?",
        "Educate me with a fun fact!",
        "Fascinate me with your knowledge!",
        "I'm curious, share a fact!",
        "Do you have an intriguing fact?",
        "Give me a random piece of information!",
        "I'm ready for a mind-blowing fact!"
    ];
    $randomFactRequest = $factRequests[array_rand($factRequests)];



    $llista_missatges = array();

    $missatgeMe = new missatge("receiver", getTextApi());
    $llista_missatges['bot'] = json_encode($missatgeMe->thisToJSON());

    $missatgeBot = new missatge("sender", $randomFactRequest );
    $llista_missatges['me'] = json_encode($missatgeBot->thisToJSON());

    header('Content-Type: application/json');

    echo json_encode($llista_missatges);

    exit();
