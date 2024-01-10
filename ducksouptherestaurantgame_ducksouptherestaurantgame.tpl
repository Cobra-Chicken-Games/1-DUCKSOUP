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
   <div class="container">
        <div class="clearfix">
        <!-- BEGIN gameBoard-->
            <div id="gameboard"></div>
        <!-- END gameBoard-->

{OVERALL_GAME_FOOTER}
