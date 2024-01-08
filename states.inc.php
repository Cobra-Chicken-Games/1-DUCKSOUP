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
 * states.inc.php
 *
 * DuckSoupTheRestaurantGame game states description
 *
 */

/*
   Game state machine is a tool used to facilitate game developpement by doing common stuff that can be set up
   in a very easy way from this configuration file.

   Please check the BGA Studio presentation about game state to understand this, and associated documentation.

   Summary:

   States types:
   _ activeplayer: in this type of state, we expect some action from the active player.
   _ multipleactiveplayer: in this type of state, we expect some action from multiple players (the active players)
   _ game: this is an intermediary state where we don't expect any actions from players. Your game logic must decide what is the next game state.
   _ manager: special type for initial and final state

   Arguments of game states:
   _ name: the name of the GameState, in order you can recognize it on your own code.
   _ description: the description of the current game state is always displayed in the action status bar on
                  the top of the game. Most of the time this is useless for game state with "game" type.
   _ descriptionmyturn: the description of the current game state when it's your turn.
   _ type: defines the type of game states (activeplayer / multipleactiveplayer / game / manager)
   _ action: name of the method to call when this game state become the current game state. Usually, the
             action method is prefixed by "st" (ex: "stMyGameStateName").
   _ possibleactions: array that specify possible player actions on this step. It allows you to use "checkAction"
                      method on both client side (Javacript: this.checkAction) and server side (PHP: self::checkAction).
   _ transitions: the transitions are the possible paths to go from a game state to another. You must name
                  transitions in order to use transition names in "nextState" PHP method, and use IDs to
                  specify the next game state for each transition.
   _ args: name of the method to call to retrieve arguments for this gamestate. Arguments are sent to the
           client side to be used on "onEnteringState" or to set arguments in the gamestate description.
   _ updateGameProgression: when specified, the game progression is updated (=> call to your getGameProgression
                            method).
*/

//    !! It is not a good idea to modify this file when a game is running !!

 
$machinestates = array(

    // The initial state. Please do not modify.
    1 => array(
        "name" => "gameSetup",
        "description" => "",
        "type" => "manager",
        "action" => "stGameSetup",
        "transitions" => array( "" => 2 )
    ),
    
    // Note: ID=2 => your first state

    2 => array(
        "name" => "gameSetup",
        "description" => clienttranslate("Setting up the game"),
        "type" => "manager",
        "action" => "stGameSetup",
        "transitions" => array( "" => 10 )
    ),
    
    // State where a player chooses a letter for the trivia question
    10 => array(
        "name" => "playerChooseLetter",
        "description" => clienttranslate('${actplayer} must select a letter for the trivia question'),
        "descriptionmyturn" => clienttranslate('${you} must select a letter for the trivia question'),
        "type" => "activeplayer",
        "possibleactions" => array( "chooseLetter" ),
        "transitions" => array( "letterChosen" => 20 )
    ),
    
    // State to handle trivia question answering
    20 => array(
        "name" => "playerAnswerQuestion",
        "description" => clienttranslate('${actplayer} must answer the trivia question'),
        "descriptionmyturn" => clienttranslate('${you} must answer the trivia question'),
        "type" => "activeplayer",
        "possibleactions" => array( "answerQuestion" ),
        "transitions" => array( "questionAnswered" => 30 )
    ),
    
    // State to handle end-of-turn events such as checking if the game has ended
    30 => array(
        "name" => "endOfTurn",
        "description" => '',
        "type" => "game",
        "action" => "stEndOfTurn",
        "updateGameProgression" => true,
        "transitions" => array( "endGame" => 99, "nextPlayer" => 10 )
    ),

    // State where the bidding round begins
    40 => array(
        "name" => "startBidding",
        "description" => clienttranslate('A staff member is up for bid'),
        "type" => "game",
        "action" => "stStartBidding",
        "transitions" => array( "nextPlayerBid" => 41 )
    ),
    
    // State for each player's bid
    41 => array(
        "name" => "playerBid",
        "description" => clienttranslate('${actplayer} can place a bid or pass'),
        "descriptionmyturn" => clienttranslate('${you} can place a bid or pass'),
        "type" => "activeplayer",
        "possibleactions" => array( "makeBid", "pass" ),
        "transitions" => array( "makeBid" => 42, "pass" => 43 )
    ),
    
    // State to check if all players have finished bidding
    42 => array(
        "name" => "checkBids",
        "description" => '',
        "type" => "game",
        "action" => "stCheckBids",
        "transitions" => array( "nextPlayerBid" => 41, "endBidding" => 44 )
    ),

    // State for a player passing on the bid
    43 => array(
        "name" => "playerPass",
        "description" => clienttranslate('${actplayer} has passed on the bid'),
        "type" => "game",
        "action" => "stPlayerPass",
        "transitions" => array( "checkEndBidding" => 42 )
    ),

    // State to conclude the bidding
    44 => array(
        "name" => "endBidding",
        "description" => clienttranslate('Bidding round has ended'),
        "type" => "game",
        "action" => "stEndBidding",
        "transitions" => array( "" => 30 ) // Assuming state 30 is the next logical state
    ),   
   
    // Final state.
    // Please do not modify (and do not overload action/args methods).
    99 => array(
        "name" => "gameEnd",
        "description" => clienttranslate("End of game"),
        "type" => "manager",
        "action" => "stGameEnd",
        "args" => "argGameEnd"
    )

);



