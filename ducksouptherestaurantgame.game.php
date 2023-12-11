<?php
 /**
  *------
  * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
  * DuckSoupTheRestaurantGame implementation : @ RJ Hidson <rhidson1@nait.ca>, @ Ashton Williams <ashtonw@nait.ca>, @ Rubelyn Ragasa <rragasa1@nait.ca>
  * 
  * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
  * See http://en.boardgamearena.com/#!doc/Studio for more information.
  * -----
  * 
  * ducksouptherestaurantgame.game.php
  *
  * This is the main file for your game logic.
  *
  * In this PHP file, you are going to defines the rules of the game.
  *
  */


require_once( APP_GAMEMODULE_PATH.'module/table/table.game.php' );


class DuckSoupTheRestaurantGame extends Table {

    function __construct() {
        parent::__construct();
        self::initGameStateLabels(array(
            "currentPlayer" => 10,
            "bankBalance" => 11,
            "souperDuckatsCount" => 12,
            "gameVariant" => 100,
        ));
    }
    

    protected function getGameName() {
        // Used for translations and stuff. Please do not modify.
        return "ducksouptherestaurantgame";
    }
    	
    /*
        setupNewGame:
        
        This method is called only once, when a new game is launched.
        In this method, you must setup the game according to the game rules, so that
        the game is ready to be played.
    */
    
    function setupNewGame($players, $options = array()) {

           // Call the method to import questions from CSV
            //$this->importQuestionsFromCSV();

        // Check if the necessary data (e.g., questions) is present in the database
        // $questionsCount = self::getUniqueValueFromDB("SELECT COUNT(*) FROM questions");
        // if ($questionsCount == 0) {
        //     throw new BgaUserException("Error: Questions data is not initialized in the database.");
        // }

        // Set the colors of the players with HTML color code
        $gameinfos = self::getGameinfos();
        $default_colors = $gameinfos['player_colors'];
    
        // Create players
        $sql = "INSERT INTO player (player_id, player_color, player_canal, player_name, player_avatar) VALUES ";
        $values = array();
        foreach ($players as $player_id => $player) {
            $color = array_shift($default_colors);
            $values[] = "('" . $player_id 
                        ."','$color','" 
                        . addslashes($player['player_canal']) 
                        . "','" . addslashes($player['player_name']) 
                        . "','" . addslashes($player['player_avatar']) 
                        . "')";
            }
            $sql .= implode(',', $values);
            self::DbQuery($sql);
            self::reattributeColorsBasedOnPreferences($players, $gameinfos['player_colors']);
            self::reloadPlayersBasicInfos();
    
        /************ Start the game initialization *****/
    
        // Initialize global values
        self::setGameStateInitialValue('currentPlayer', 0); // Assuming 'currentPlayer' is a global variable
        self::setGameStateInitialValue('bankBalance', 0); // Assuming 'bankBalance' is a global variable
        self::setGameStateInitialValue('souperDuckatsCount', 3); // Assuming each player starts with 3 Souper Duckats
    
        // Initialize game statistics
        self::initStat('table', 'totalRounds', 0); // Initialize a table statistic
        self::initStat('player', 'totalPoints', 0); // Initialize a player statistic for all players
    
        // Setup the initial game situation
        // This can include setting up the board, dealing cards, distributing resources, etc.
        // For DuckSoup, you might need to distribute initial staff, set up the restaurant cards, etc.
        $this->setupInitialGameBoard();
        $this->distributeInitialStaff();
        $this->setupRestaurantCards();
        
        // Activate the first player
        $this->gamestate->changeActivePlayer($player_id);
    
        /************ End of the game initialization *****/
    }
   
    // function importQuestionsFromCSV() {

    //     $questions = [
    //         [
    //             'duckats_value' => '40',
    //             'category' => 'Additives',
    //             'question_text' => 'Kwok disease results from overuse of',
    //             'answer_a' => 'Artificial Coloring',
    //             'answer_b' => 'Monosodium Glutamate',
    //             'answer_c' => 'Sulfites',
    //             'answer_d' => '',
    //             'correct_answer' => 'B',
    //             'answer_text' => "The symptoms of Kwok's disease are burning pains in the chest, dizziness and numbness. "
    //         ],
    //         [
    //             'duckats_value' => '50',
    //             'category' => 'Additives',
    //             'question_text' => 'Xantham gum, a thickener, emulsifier and stabilizer in dairy products, dressings and other foods, is made from',
    //             'answer_a' => 'Artificial Ingredients',
    //             'answer_b' => 'Glucose',
    //             'answer_c' => 'Palm Oil',
    //             'answer_d' => 'Potato Starch',
    //             'correct_answer' => 'B',
    //             'answer_text' => ''
    //         ],
    //         [
    //             'duckats_value' => '30',
    //             'category' => 'Baking',
    //             'question_text' => 'True or false? Baking at high altitudes requires more yeast or baking powder.',
    //             'answer_a' => 'TRUE',
    //             'answer_b' => 'FALSE',
    //             'answer_c' => '',
    //             'answer_d' => '',
    //             'correct_answer' => 'B',
    //             'answer_text' => 'It requires less yeast or baking powder. The higher the altitude, the lower the atmospheric pressure, which means that the carbon dioxide generated in baking encounters less resistance from the surrounding air.'
    //         ],
    //         // ... more questions
    //     ];

    // // // Path to the CSV file
    // // $filename = '/ducksouptherestaurantgame/ducksouptherestaurantgame/modules/csv/questions.csv';
    // // echo getcwd();

    // // //error handling for the csv file import
    // // if (!file_exists($filename)) {
    // //     die("File not found: $filename");
    // // } else if (!is_readable($filename)) {
    // //     die("File not readable: $filename");
    // // }

    // // $questionsArray = []; // This will hold the main array of questions

    // // // Open the CSV file for reading
    // // if (($handle = fopen($filename, "r")) !== FALSE) {
    // //     $headers = fgetcsv($handle); // Read the first row as headers
    
    // //     // Loop through each row of the CSV file
    // //     while (($data = fgetcsv($handle)) !== FALSE) {
    // //         // Build the question array using the headers for keys
    // //         $question = array_combine($headers, $data);
    
    // //         // Extract the answers and correct answer into their own sub-array
    // //         $answers = [
    // //             'answer_a' => $question['answer_a'],
    // //             'answer_b' => $question['answer_b'],
    // //             'answer_c' => $question['answer_c'],
    // //             'answer_d' => $question['answer_d'],
    // //             'correct_answer' => $question['correct_answer'],
    // //             'answer_text' => $question['answer_text']
    // //         ];
    
    // //         // Remove the individual answers from the main question array
    // //         unset($question['answer_a'], $question['answer_b'], $question['answer_c'], $question['answer_d'], $question['correct_answer'], $question['answer_text']);
    
    // //         // Add the answers sub-array to the question
    // //         $question['answers'] = $answers;
    
    // //         // Add the question array to the main questions array
    // //         $questionsArray[] = $question;
    // //     }
    // //     fclose($handle);
    // }

    function setupInitialGameBoard() {
        // TO DO:
        // Set up the initial game board.
        // This could include setting up the restaurant cards, distributing initial staff, etc.
        // For DuckSoup, you might need to distribute initial staff, set up the restaurant cards, etc.
        // ...
    }
    
    function distributeInitialStaff() {
        // TO DO:
        // Distribute initial staff to players.
        // For DuckSoup, you might need to distribute initial staff, set up the restaurant cards, etc.
        // ...
    }

    function changeActivePlayer($player_id) {
            // Check if the provided player ID is valid
        if (!isset($this->players[$player_id])) {
            throw new BgaUserException("Invalid player ID: $player_id");
        }

        // Change the active player
        $this->gamestate->changeActivePlayer($player_id);
    }

    /*
        getAllDatas: 
        
        Gather all informations about current game situation (visible by the current player).
        
        The method is called each time the game interface is displayed to a player, ie:
        _ when the game starts
        _ when a player refreshes the game page (F5)
    */

    function setupRestaurantCards() {
        // TO DO:
        // Set up the restaurant cards.
        // For DuckSoup, you might need to distribute initial staff, set up the restaurant cards, etc.
        // ...
    }   
    

    function getAllDatas() 
    {
        $result = array();

        $current_player_id = self::getCurrentPlayerId();    // Get the id of the current player

        // Get information about players
        // If you have additional player fields in the database, like 'player_avatar', you can add them here
        $sql = "SELECT player_id id, player_score score, player_color color, player_avatar avatar FROM player ";
        $result['players'] = self::getCollectionFromDb($sql);

        // Get other public game state data that is not specific to any player
        // This could include data like the state of the game board, any public counters, etc.
        // Example:
        // $result['gameBoard'] = self::getGameBoardData();

        // Get private data specific to the current player
        // This is where you add code to get private data that only the current player should see.
        // For example, if your game involves hidden cards in the player's hand, you would retrieve them here.
        // Example:
        // $result['hand'] = $this->getPlayerHand($current_player_id);

        // If there is data that all players should receive but it's formatted differently for the current player,
        // that processing should be done here.
        // Example:
        // $result['playerData'] = $this->getPlayerSpecificData($current_player_id);

        // If your game has elements that change during the game and players need to keep track of them,
        // like resources, you'd query those here.
        // Example:
        // $result['resources'] = $this->getPlayerResources($current_player_id);

        // It's important that any sensitive data not be sent to the player unless it's their own.
        // Always filter out any secret information that the current player should not see.

        // If there are global objects or states that are affected by player actions and need to be synchronized with the client-side,
        // you should also retrieve them here.
        // Example:
        // $result['globalEvent'] = self::getGlobalEventData();

        return $result;
    }


    /*
        getGameProgression:
        
        Compute and return the current game progression.
        The number returned must be an integer beween 0 (=the game just started) and
        100 (= the game is finished or almost finished).
    
        This method is called each time we are in a game state with the "updateGameProgression" property set to true 
        (see states.inc.php)
    */

    function getGameProgression()
    {
        // Assuming the victory condition is to have a full set of Excellent staff
        // Define the total number of Excellent staff needed to win the game
        $totalExcellentStaffNeeded = 12; // This number should be adjusted based on the game's rules
    
        // Calculate the current progression towards this goal for all players
        $sql = "SELECT player_id, COUNT(staff_id) AS excellentStaffCount FROM staff WHERE staff_quality = 'Excellent' GROUP BY player_id";
        $playersStaffCounts = self::getCollectionFromDb($sql);
    
        $highestProgress = 0;
        foreach ($playersStaffCounts as $playerId => $staffData) {
            $currentProgress = ($staffData['excellentStaffCount'] / $totalExcellentStaffNeeded) * 100;
            if ($currentProgress > $highestProgress) {
                $highestProgress = $currentProgress;
            }
        }
    
        // Ensure that the progression does not exceed 100%
        $highestProgress = min(100, $highestProgress);
    
        // Cast the progression to an integer to conform with the expected return type
        return (int)$highestProgress;
    }


//////////////////////////////////////////////////////////////////////////////
//////////// Utility functions
////////////    

    /*
        In this space, you can put any utility methods useful for your game logic
    */



//////////////////////////////////////////////////////////////////////////////
//////////// Player actions
//////////// 

    /*
        Each time a player is doing some game action, one of the methods below is called.
        (note: each method below must match an input method in ducksouptherestaurantgame.action.php)
    */

    function playCard1($card_id)
    {
        self::checkAction('playCard'); // Ensure it's the correct state and player's turn.
        
        $player_id = self::getActivePlayerId();
        
        // Validate the card is playable (it's in the player's hand, not already played, etc.)
        // ...
    
        // Execute the logic for playing the card.
        // This could involve modifying the database to move the card from the player's hand to the table,
        // updating the game state, applying card effects, etc.
        // ...
    
        // Get the card name for the notification message (you would retrieve this from your data model)
        $card_name = $this->getCardName($card_id);
    
        // Notify all players that the card has been played.
        self::notifyAllPlayers('cardPlayed', clienttranslate('${player_name} plays ${card_name}'), array(
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'card_name' => $card_name,
            'card_id' => $card_id
        ));
    
        // Determine and set the next game state.
        $this->gamestate->nextState('nextAction');
    }
    
    function chooseAnswer($answer_id)
    {
        self::checkAction('chooseAnswer');
        
        $player_id = self::getActivePlayerId();
        
        // Implement the logic for choosing an answer.
        // For example, record the answer chosen in the database, 
        // check if it's correct, update scores, etc.
        // ...
    
        // Notify players about the answer chosen.
        self::notifyAllPlayers('answerChosen', clienttranslate('${player_name} has chosen an answer'), array(
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'answer_id' => $answer_id
        ));
    
        // Check if all players have chosen an answer and move to the next game state if so.
        // ...
    
        $this->gamestate->nextState('evaluateAnswers');
    }
    
    function makeBid($amount)
    {
        self::checkAction('makeBid');
        
        $player_id = self::getActivePlayerId();
        
        // Implement the logic for making a bid.
        // This could involve checking if the bid is valid (e.g., not exceeding player's resources),
        // updating the current bid amount, etc.
        // ...
    
        // Notify players about the bid.
        self::notifyAllPlayers('bidMade', clienttranslate('${player_name} bids ${amount}'), array(
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'amount' => $amount
        ));
    
        // Move to the next player or resolve the bidding if this is the last bid.
        // ...
    
        $this->gamestate->nextState('nextPlayerBid');
    }
    
    // You can add more functions for different actions following the same pattern.
    

    
//////////////////////////////////////////////////////////////////////////////
//////////// Game state arguments
////////////

    function playCard2($card_id) {
        // Check that the player can play a card now (based on the game state defined in states.inc.php)
        self::checkAction('playCard');
    
        $player_id = self::getActivePlayerId();
        
        // Assuming there's a table 'cards' where cards are stored with a 'card_id' and 'card_location'
        // Verify that the card belongs to the player and is in a location from which it can be played
        $sql = "SELECT card_id FROM cards WHERE card_id = ? AND card_location = 'hand' AND player_id = ?";
        $card = self::getObjectFromDb($sql, array($card_id, $player_id));
        
        if(!$card) {
            throw new BgaUserException(self::_("You can't play this card."));
        }
        
        // Add your game logic to play a card
        // For example, move the card to the 'table' and update any game state as needed
        $sql = "UPDATE cards SET card_location = 'table' WHERE card_id = ?";
        self::DbQuery($sql, array($card_id));
        
        // Assuming the card has a name, we get it for the notification
        $card_name = self::getCardNameById($card_id);
        
        // Notify all players about the card played using the translation client system
        self::notifyAllPlayers("cardPlayed", clienttranslate('${player_name} plays ${card_name}'), array(
            'player_id' => $player_id,
            'player_name' => self::getActivePlayerName(),
            'card_name' => $card_name,
            'card_id' => $card_id
        ));
        
        // Depending on your game, you may want to trigger some other effects, change the game state, etc.
        // You can do it here if needed.

        //TO DO: Create special effects and game state changes here
        
        // Finally, after playing a card, you may want to move to the next player or next state
        $this->gamestate->nextState('cardPlayed');
    }
    
    function getCardNameById($card_id) {
        // This function would retrieve the card's name based on its ID.
        // This is a placeholder; you would replace this with the actual logic to get a card's name.
        $sql = "SELECT card_name FROM cards WHERE card_id = ?";
        return self::getUniqueValueFromDb($sql, array($card_id));
    }

//////////////////////////////////////////////////////////////////////////////
//////////// Game state actions
////////////

function stStartTurn()
{
    // Perform any necessary setup for the start of a turn.
    
    // Example: Reset any per-turn state variables or counters.
    self::setGameStateValue('someVariable', 0);
    
    // Check if any special conditions are met at the start of a turn.
    // ...
    
    // Notify players that a new turn has started.
    self::notifyAllPlayers('newTurn', clienttranslate('A new turn starts'), array(
        // 'data' => $data // any data you want to send to the client
    ));
    
    // Transition to the next state, which could be 'playerAction' or something similar.
    $this->gamestate->nextState('playerTurnStart');
}

function stPlayerAction()
{
    // If the player can make a decision or play a card, this state allows for that.
    // No specific code is needed here because the action will be handled by the player's input functions.
}

function stEndTurn()
{
    // Clean up after a turn.
    // Example: Check if any end-of-turn effects need to be resolved.
    // ...
    
    // Move to the next player or end the game if conditions are met.
    if ($this->checkEndGameCondition()) {
        $this->gamestate->nextState('endGame');
    } else {
        $this->activeNextPlayer();
        $this->gamestate->nextState('nextPlayer');
    }
}

function stCheckEndGame()
{
    // Determine if the game has reached a condition where it should end.
    // Example: All cards have been played or a score limit has been reached.
    if ($this->isGameOver()) {
        // Perform any end of game scoring or cleanup.
        // ...
        
        // Notify players that the game has ended and show results.
        self::notifyAllPlayers('gameEnd', clienttranslate('The game is over!'), array(
            'results' => $this->getGameResults() // Method to calculate and return game results.
        ));
        
        // Transition to the game end state.
        $this->gamestate->nextState('endGame');
    } else {
        // If the game is not over, continue to the next turn.
        $this->gamestate->nextState('nextTurn');
    }
}

function isGameOver()
{
    // Check if the game should end. Return true if it should, false otherwise.
    // ...
    return false; // Placeholder - replace with actual game end condition.
}

function getGameResults(): array
{
    $scores = [];
    foreach ($this->players as $player_id => $player) {
        // Calculate score for the current player.
        // Replace this with your actual score calculation.
        $score = 0; 

        $scores[$player_id] = $score;
    }
    return $scores; // Replace with actual results calculation.
}

function checkEndGameCondition()
{
    // Check if an end game condition has been reached.
    // ...
    return false; // Placeholder - replace with actual end game condition check.
}

//////////////////////////////////////////////////////////////////////////////
//////////// Zombie
////////////

    /*
        zombieTurn:
        
        This method is called each time it is the turn of a player who has quit the game (= "zombie" player).
        You can do whatever you want in order to make sure the turn of this player ends appropriately
        (ex: pass).
        
        Important: your zombie code will be called when the player leaves the game. This action is triggered
        from the main site and propagated to the gameserver from a server, not from a browser.
        As a consequence, there is no current player associated to this action. In your zombieTurn function,
        you must _never_ use getCurrentPlayerId() or getCurrentPlayerName(), otherwise it will fail with a "Not logged" error message. 
    */

    function zombieTurn( $state, $active_player )
    {
    	$statename = $state['name'];
    	
        if ($state['type'] === "activeplayer") {
            switch ($statename) {
                default:
                    $this->gamestate->nextState( "zombiePass" );
                	break;
            }

            return;
        }

        if ($state['type'] === "multipleactiveplayer") {
            // Make sure player is in a non blocking status for role turn
            $this->gamestate->setPlayerNonMultiactive( $active_player, '' );
            
            return;
        }

        throw new feException( "Zombie mode not supported at this game state: ".$statename );
    }
    
///////////////////////////////////////////////////////////////////////////////////:
////////// DB upgrade
//////////

    /*
        upgradeTableDb:
        
        You don't have to care about this until your game has been published on BGA.
        Once your game is on BGA, this method is called everytime the system detects a game running with your old
        Database scheme.
        In this case, if you change your Database scheme, you just have to apply the needed changes in order to
        update the game database and allow the game to continue to run with your new version.
    
    */
    
    function upgradeTableDb( $from_version )
    {}
        // $from_version is the current version of this game database, in numerical form.
        // For example, if the game was running with a release of your game named "140430-1345",
        // $from_version is equal to 1404301345
        
      // Example:
//       if( $from_version <= 1404301345 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "ALTER TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        if( $from_version <= 1405061421 )
//        {
//            // ! important ! Use DBPREFIX_<table_name> for all tables
//
//            $sql = "CREATE TABLE DBPREFIX_xxxxxxx ....";
//            self::applyDbUpgradeToAllDB( $sql );
//        }
//        // Please add your future database scheme changes here

}

?>