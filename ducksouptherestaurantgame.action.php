<?php
/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * DuckSoupTheRestaurantGame implementation : @ RJ Hidson <rhidson1@nait.ca>, @ Ashton Williams <ashtonw@nait.ca>, @ Rubelyn Ragasa <rragasa1@nait.ca>
 *
 * This code has been produced on the BGA studio platform for use on https://boardgamearena.com.
 * See http://en.doc.boardgamearena.com/Studio for more information.
 * -----
 * 
 * ducksouptherestaurantgame.action.php
 *
 * DuckSoupTheRestaurantGame main action entry point
 *
 *
 * In this file, you are describing all the methods that can be called from your
 * user interface logic (javascript).
 *       
 * If you define a method "myAction" here, then you can call it from your javascript code with:
 * this.ajaxcall( "/ducksouptherestaurantgame/ducksouptherestaurantgame/myAction.html", ...)
 *
 */
  
  
  class action_ducksouptherestaurantgame extends APP_GameAction
  { 
    // Constructor: please do not modify
   	public function __default()
  	{
  	    if( self::isArg( 'notifwindow') )
  	    {
            $this->view = "common_notifwindow";
  	        $this->viewArgs['table'] = self::getArg( "table", AT_posint, true );
  	    }
  	    else
  	    {
            $this->view = "ducksouptherestaurantgame_ducksouptherestaurantgame";
            self::trace( "Complete reinitialization of board game" );
      }
  	} 
  	
      public function playCard($card_id)
      {
          self::checkAction('playCard'); // Ensure it's the correct state and player's turn.
  
          $player_id = self::getActivePlayerId();
          
          // TODO: Validate the card is playable.
          
          // TODO: Execute the logic for playing the card.
  
          $card_name = $this->getCardName($card_id); // TODO: Define this method to get the card name.
  
          // Notify all players that the card has been played.
          self::notifyAllPlayers('cardPlayed', clienttranslate('${player_name} plays ${card_name}'), [
              'player_id' => $player_id,
              'player_name' => self::getActivePlayerName(),
              'card_name' => $card_name,
              'card_id' => $card_id
          ]);
  
          // Determine and set the next game state.
          $this->gamestate->nextState('nextAction');
      }
  
      public function chooseAnswer($answer_id)
      {
          self::checkAction('chooseAnswer');
          
          $player_id = self::getActivePlayerId();
          
          // TODO: Implement the logic for choosing an answer.
  
          // Notify players about the answer chosen.
          self::notifyAllPlayers('answerChosen', clienttranslate('${player_name} has chosen an answer'), [
              'player_id' => $player_id,
              'player_name' => self::getActivePlayerName(),
              'answer_id' => $answer_id
          ]);
  
          // TODO: Check if all players have chosen an answer and move to the next game state if so.
  
          $this->gamestate->nextState('evaluateAnswers');
      }
  
      public function makeBid($amount)
      {
          self::checkAction('makeBid');
          
          $player_id = self::getActivePlayerId();
          
          // TODO: Implement the logic for making a bid.
  
          // Notify players about the bid.
          self::notifyAllPlayers('bidMade', clienttranslate('${player_name} bids ${amount}'), [
              'player_id' => $player_id,
              'player_name' => self::getActivePlayerName(),
              'amount' => $amount
          ]);
  
          // TODO: Move to the next player or resolve the bidding.
  
          $this->gamestate->nextState('nextPlayerBid');
      }
  
      // ... Additional action functions ...
  
}

  

