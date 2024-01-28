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
         $players = $this->game->loadPlayersBasicInfos(); //loadPlayersBasicInfos() is part of BGA's base code.
         $players_nbr = count($players);
 
         /*********** Place your code below:  ************/
         $this->tpl['MY_HAND'] = self::_("Your staff:");
         $this->tpl['QUESTIONS'] = self::_("Trivia Questions:");
         $this->tpl['DUCKATS'] = self::_("Duckats:");
         $this->tpl['SOUPERDUCKATS'] = self::_("Souper Duckats:");


         //Assign the blocks to the tpl
         $this->page->begin_block("ducksouptherestaurantgame_ducksouptherestaurantgame", "duckats_block");
         $this->page->begin_block("ducksouptherestaurantgame_ducksouptherestaurantgame", "souperduckats_block");
         $this->page->begin_block("ducksouptherestaurantgame_ducksouptherestaurantgame", "playerstats_block"); //not showing up
         $this->page->begin_block("ducksouptherestaurantgame_ducksouptherestaurantgame", "trivia_block"); //not showing up
         $this->page->begin_block("ducksouptherestaurantgame_ducksouptherestaurantgame", "left_content"); //nothing in here
         $this->page->begin_block("ducksouptherestaurantgame_ducksouptherestaurantgame", "staff_block");
         $this->page->begin_block("ducksouptherestaurantgame_ducksouptherestaurantgame", "gameboard");

        // Example: setting up the staff area for each player
        foreach ($players as $player_id => $player) {
            $this->page->insert_block("staff_block", array(
                "PLAYER_ID" => $player_id,
                "PLAYER_COLOR" => $player['player_color'],
                "PLAYER_NAME"  => $player['player_name']
            ));
        }

        //Insert gameboard arry
        $this->page->insert_block("gameboard", array(

        ));

           // Example: setting up the duckats and souper duckats display
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
            $this->page->reset_subblocks( 'duckats_block' );
            $this->page->reset_subblocks( 'souperduckats_block' );
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
 
         /*********** Do not change anything below this line  ************/
     }
    }
?>
