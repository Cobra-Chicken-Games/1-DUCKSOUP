<?php

if (!defined('APP_GAMEMODULE_PATH')) {
    define('APP_GAMEMODULE_PATH', '');
}

require_once('./ducksouptherestaurantgame.game.php'); 

class fetchQuestion extends ducksouptherestaurantgame {
    function __construct() {
        parent::__construct();
        include '../material.inc.php';
    }
}

function fetchQuestionData {
    if(isset($_GET['questionId'])) {
        $gameInstance = new DuckSoupTheRestaurantGame(); // Replace with your actual game class name
        $questionId = intval($_GET['questionId']);
        $gameInstance->getTriviaQuestions($questionId);
    } else {
        echo json_encode(['error' => 'Question ID not provided.']);
    }
}

?>