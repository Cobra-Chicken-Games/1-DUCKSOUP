{OVERALL_GAME_HEADER}

<!-- 
--------
-- BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
-- Hearts implementation fixes: © ufm <tel2tale@gmail.com>
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-------

    hearts_hearts.tpl
    
    This is the HTML template of your game.
    
    Everything you are writing in this file will be displayed in the HTML page of your game user interface,
    in the "main game zone" of the screen.
    
    You can use in this template:
    _ variables, with the format {MY_VARIABLE_ELEMENT}.
    _ HTML block, with the BEGIN/END format
    
    See your "view" PHP file to check how to set variables and control blocks
-->

<!--
-- Note: this code is modified to add suggestions from BGA players and popular variants.
-- Please visit here to read the basic code used in the BGA Studio tutorial: https://github.com/elaskavaia/
-->
{include file="game_elements.html" type="css" rel="stylesheet" media="screen,projection"}
{include file="game_elements.js" type="javascript"}

<div id="game_interface">
    <div id="game_board">
        <!-- Staff Area for Each Player -->
        {foreach from=$players item=player}
            <!-- BEGIN staff_block -->
            <div class="player_staff" id="player_staff_{$player.PLAYER_ID}" style="background-color:{$player.PLAYER_COLOR};">
                <div class="player_name">{$player.PLAYER_NAME}</div>
                <div class="staff_content">
                    <!-- Dynamic content will be inserted here -->
                </div>
            </div>
            <!-- END staff_block -->
        {/foreach}
        
        <!-- Trivia Questions Block -->
        <!-- BEGIN trivia_block -->
        <div id="trivia_questions">
            {$QUESTIONS_HTML}
        </div>
        <!-- END trivia_block -->
        
        <!-- Duckats Block -->
        {foreach from=$players item=player}
            <!-- BEGIN duckats_block -->
            <div class="player_duckats" id="player_duckats_{$player.PLAYER_ID}">
                <span class="duckats_label">{$DUCKATS}</span>
                <span class="duckats_count">{$player.DUCKATS_COUNT}</span>
            </div>
            <!-- END duckats_block -->
            
            <!-- BEGIN souperduckats_block -->
            <div class="player_souperduckats" id="player_souperduckats_{$player.PLAYER_ID}">
                <span class="souperduckats_label">{$SOUPERDUCKATS}</span>
                <span class="souperduckats_count">{$player.SOUPERDUCKATS_COUNT}</span>
            </div>
            <!-- END souperduckats_block -->
        {/foreach}
        
        <!-- Dice Roll Button (shown/hidden via JavaScript) -->
        <div id="dice_roll_area">
            {$ROLL_DICE_HTML}
        </div>

        <!-- Game Message -->
        <div id="game_message">
            {$GAME_MESSAGE}
        </div>
    </div>
</div>
