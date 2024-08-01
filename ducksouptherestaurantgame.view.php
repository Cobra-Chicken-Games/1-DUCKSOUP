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
 * ducksouptherestaurantgame.view.php
 *
 * This is your "view" file.
 *
 * The method "build_page" below is called each time the game interface is displayed to a player, ie:
 * _ when the game starts
 * _ when a player refreshes the game page (F5)
 *
 * "build_page" method allows you to dynamically modify the HTML generated for the game interface. In
 * particular, you can set here the values of variables elements defined in ducksouptherestaurantgame_ducksouptherestaurantgame.tpl (elements
 * like {MY_VARIABLE_ELEMENT}), and insert HTML block elements (also defined in your HTML template file)
 *
 * Note: if the HTML of your game interface is always the same, you don't have to place anything here.
 *
 */
  
 require_once(APP_BASE_PATH . "view/common/game.view.php");

 class view_ducksouptherestaurantgame_ducksouptherestaurantgame extends game_view
 {
     function getGameName()
     {
         return "ducksouptherestaurantgame";
     }
 
    function build_page($viewArgs)
     {
         global $g_user;
         $players = $this->game->loadPlayersBasicInfos(); //loadPlayersBasicInfos() is part of BGA's base code.
         $players_nbr = count($players);


         /*********** Place your code below:  ************/

         //Assign the blocks to the tpl
         $this->page->begin_block("ducksouptherestaurantgame_ducksouptherestaurantgame", "gameboard");
         $this->page->begin_block("ducksouptherestaurantgame_ducksouptherestaurantgame", "staffboard");
         $this->page->begin_block("ducksouptherestaurantgame_ducksouptherestaurantgame", "playerstats_block");
         $this->page->insert_block("gameboard", array( "BOARD-CONTENT-STATE" => "hidden",));

        // Method to get the active player's ID
        $active_player_id = $this->game->getActivePlayerId(); 
         foreach ($players as $player_id => $player) {
             if ($player_id == $active_player_id) {
                //get the stats for duckats and souperduckats for each player
                $duckatsCount = $this->game->getStat('duckats', $player_id);
                $souperDuckatsCount = $this->game->getStat('souperDuckats', $player_id);
                 // Insert the playerstats_block only for the active player
                 $this->page->insert_block("playerstats_block", array(
                     "PLAYER_ID" => $player_id,
                     "PLAYER_COLOR" => $player['player_color'],
                     "PLAYER_NAME" => $player['player_name'],
                     "PLAYER-SDUCKATS" =>$souperDuckatsCount,
                     "PLAYER-DUCKATS" =>$duckatsCount
                 ));
                 break; // Since we only need to insert the block for the active player, we can break the loop after insertion
             }
         }

  

        /* Begin the staffboard block array, fetch command to toggle messages after triva */
        $this->page->insert_block("staffboard", array(
            "HIDDEN-CONTENT-1" => "hidden-content",
            "HIDDEN-CONTENT-2" => "hidden-content",
            "HIDDEN-CONTEN-3" => "hidden-content",
            "HIDDEN-CONTENT-4" => "hidden-content",
            "HIDDEN-CONTENT-5" => "hidden-content",
            "HIDDEN-CONTENT-6" => "hidden-content",
            "HIDDEN-CONTENT-7" => "hidden-content",
            "HIDDEN-CONTENT-8" => "hidden-content",
            "HIDDEN-CONTENT-9" => "hidden-content",
            "HIDDEN-CONTENT-10" => "hidden-content",
            "HIDDEN-CONTENT-11" => "hidden-content",
            "HIDDEN-CONTENT-12" => "hidden-content",
        ));
        

     

        /*
        /* setting up the duckats and souper duckats display 
        foreach ($players as $player_id => $player) {
            $duckatsCount = $this->game->getStat('duckats', $player_id);
            $souperDuckatsCount = $this->game->getStat('souperDuckats', $player_id);
        
            $this->page->insert_block("duckats_block", array(
                "PLAYER_ID" => $player_id,
                "DUCKATS_COUNT" => $duckatsCount
                
            ));
            $this->page->insert_block("souperduckats_block", array(
                "PLAYER_ID" => $player_id,
                "SOUPERDUCKATS_COUNT" => $souperDuckatsCount
                // ... other player-specific variables for souper duckats
            ));
            $this->page->insert_block("playerstats_block", array(
                "PLAYER_ID" => $player['player_name']
                // ... other player-specific variables for souper duckats
            ));
            $this->page->reset_subblocks( 'playerstats_block' );
        }
        
         // Example: setting up the trivia questions block
         $boardInfo = $this ->game->getBoardInfo();
         $trivia_questions = $this->game->getTriviaQuestions(); // method to get trivia questions from game logic
         $this->page->insert_block("trivia_block", array(
            "BOARD_TITLE" => $boardInfo['boardTitle'],
            "BOARD_TEXT" => $boardInfo['boardText'],
            "QUESTIONS_HTML" => $trivia_questions, // HTML content for trivia questions
         ));
         
         //setup the staff block
         $staff_content = $this->game->getPlayerStaff();
         $this->page->insert_block("staff_block", array(
            "PLAYER_STAFF" => $trivia_questions, 
        ));

        //setup the left playboard
       
        $this->page->insert_block("left_content", array(
                //TODO: Insert left content for player board here.
        ));
    
         // Dice roll button visibility will be controlled by the game logic
         // Add buttons for rolling dice but these will be shown/hidden via JavaScript based on game state
        $this->tpl['ROLL_DICE_HTML'] = self::raw($this->game->getRollDiceButtonHtml());
    
        public function cssClass() {
            return "";
        }
        
        public function boardText() {
            return "TESTING THE SPRITES FROM CSS AND VIEW";
        }

         /*********** Do not change anything below this line  ************/
    }  
}


?>
