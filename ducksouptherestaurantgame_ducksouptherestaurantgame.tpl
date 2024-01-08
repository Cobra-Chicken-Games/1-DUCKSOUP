{OVERALL_GAME_HEADER}

<!-- Game Board -->
<div id="gameBoard">
    <div class="container">
        <div class="clearfix">

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
                    <div id="gameboard" class="gameboard">
                    {PLAYER_NAME}
                    </div>
                <!-- END gameBoard-->
            <!-- RIGHT CONTENT -->
            <div class="right-content">

                <!-- TRIVIA BUTTONS -->
                <div class="letter-buttons">
                    <button id="letter-a">A</button>
                    <button id="letter-b">B</button>
                    <button id="letter-c">C</button>
                    <button id="letter-d">D</button>
                </div>

                <!-- BEGIN dice -->
                <!-- DICE BUTTONS -->
                <div class="dice">
                <div class="dice-buttons">
                    <!-- STAFF DIE -->
                    <button id="staff-die">
                        <span>Roll the<br>Staff Die</span>
                    </button>

                    <!-- MOVEMENT DICE -->
                    <button id="move-die">
                        <span>Roll for<br>Movement</span>
                    </button>
                </div>
                <!-- END dice -->
                <!-- BEGIN staff-board -->
                <div id="staff-board" class="staff-board">
                    <div class="staff-board-container">
                        <!-- STAFF BOARD ARROWS -->
                            <button id="left-arrow" class="arrow"><span></span></button>
                            <button id="right-arrow" class="arrow"><span></span></button>

                            <div class="player-header">
                <!-- STAFF BOARD CONTAINER -->
                <!-- BEGIN gameboard -->
                <div class="staff-board-container">
                    <!-- STAFF BOARD ARROWS -->
                    <button id="left-arrow" class="arrow"><span></span></button>
                    <button id="right-arrow" class="arrow"><span></span></button>

                    <div class="player-header">
                        <div class="clearfix">
                            <!-- PLAYER NAME -->
                            <div class="player-name left player_${PLAYER_COLOR}">
                                ${PLAYER_NAME}
                            </div>

                            <!-- PLAYER STATS -->
                            <div class="player-stats right">
                                <div class="clearfix">
                                    <!-- PLAYER NAME -->
                                    <div class="player-name left player_${PLAYER_COLOR}">
                                        ${PLAYER_NAME}
                                    </div>

                                    <!-- PLAYER STATS -->
                                    <div class="player-stats right">
                                        <div class="clearfix">
                                            <div class="left">
                                                <!-- SUPER DUCKATS -->
                                                <div class="clearfix super-duckat">
                                                    <div class="value left">
                                                        ${PLAYER_SUPER_DUCKATS}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="left">
                                                <!-- DUCKATS -->
                                                <div class="clearfix duckat">
                                                    <div class="value left">
                                                        ${PLAYER_DUCKATS}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="player-background player_${PLAYER_COLOR}"></div>
                            </div>
                </div>
                </div>
                <!-- END staff-board -->
                        </div>

                        <div class="player-background player_${PLAYER_COLOR}"></div>
                    </div>

                    <!-- STAFF BOARD -->
                    <img class="staff-board" src="./img/staff-board.jpg">
                </div>
                <!-- END gameboard -->
            </div>

            <!-- LEFT CONTENT -->
            <div class="left-content">
                    <!-- DUCK IMAGE TO DISPLAY BY DEFAULT, HIDDEN WHEN CONTENT SHOWN -->

                    <!-- WRITTEN CONTENT SHOWN IN MIDDLE OF BOARD, INACTIVE BY DEFAULT -->
                    <div class="board-contents active">
                        <h2>${BOARD_TITLE}</h2>
                        <p>${BOARD_TEXT}</p>
                    </div>

                    <!-- BOARD -->
                    <img class="board" src="./img/board.jpg">
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // Javascript HTML templates
    // Define templates for dynamic elements here, using variables from your JavaScript file
</script>

{OVERALL_GAME_FOOTER}
