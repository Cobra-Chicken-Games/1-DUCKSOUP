<?php

include_once('./ducksouptherestaurantgame.game.php'); // Adjust the path as necessary

if(isset($_GET['questionId'])) {
    $gameInstance = new DuckSoupTheRestaurantGame(); // Replace with your actual game class name
    $questionId = intval($_GET['questionId']);
    $gameInstance->getTriviaQuestions($questionId);
} else {
    echo json_encode(['error' => 'Question ID not provided.']);
}

?>