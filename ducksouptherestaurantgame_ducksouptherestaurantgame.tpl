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

<!-- BEGIN gameboard -->
<div class="gameboard">
    <div class="container">
        <div class="clearfix">
            <!-- RIGHT CONTENT -->
            <div class="right-content">
                <!-- TRIVIA BUTTONS -->
                    <div class="letter-buttons">
                        <button id="letter-a">A</button>
                        <button id="letter-b">B</button>
                        <button id="letter-c">C</button>
                        <button id="letter-d">D</button>
                    </div>        
                
                <!-- DICE BUTTONS -->
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

                <!-- STAFF BOARD CONTAINER -->
				<!-- BEGIN staff_block -->
                <div class="staff-board-container">
                    <!-- STAFF BOARD ARROWS -->
                    <button id="left-arrow" class="arrow"><span></span></button>
                    <button id="right-arrow" class="arrow"><span></span></button>
                    <!-- staff board header -->
                    <div class="player-header">
                        <div class="clearfix">
                        <!-- PLAYER NAME -->
                        <!-- BEGIN playerstats_block -->
                            <div class="player-name left player_${PLAYER_COLOR}">
                                ${PLAYER_NAME}
                            </div>
                            <!-- PLAYER STATS -->
                            <div class="player-stats right">
                                <div class="clearfix">
                                    <div class="left">
                                        <!-- SUPER DUCKATS -->
										<!-- BEGIN souperduckats_block -->
                                        <div class="clearfix super-duckat">
                                            <div class="value left">
                                                ${PLAYER_SUPER_DUCKATS}
                                            </div>
                                        </div>
										<!-- END souperduckats_block -->
                                    </div>
									<!-- BEGIN duckats_block -->
                                    <div class="left">
                                        <!-- DUCKATS -->
                                        <div class="clearfix duckat">
                                            <div class="value left">
                                                ${PLAYER_DUCKATS}
                                            </div>
                                        </div>
                                    </div>
									<!-- END duckats_block -->
                                </div>
                            </div>
                        <!-- END playerstats_block -->
                        </div>
                        <div class="player-background player_${PLAYER_COLOR}"></div>
                    </div>
                    <div class="clearfix">
                        <div class="staff-board">
                        ${PLAYER_STAFF}
                        </div>
                    </div>
                </div>
				<!-- END staff_block -->
            </div>
            <!-- LEFT CONTENT -->
            <div class="left-content">
                <!-- WRITTEN CONTENT SHOWN IN MIDDLE OF BOARD, INACTIVE BY DEFAULT -->
                
                <div class="board-contents inactive">
                <!-- BEGIN trivia_block -->
                    <h2>${BOARD_TITLE}</h2>
                    <p>${BOARD_TEXT}</p>
                <!-- END trivia_block -->
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- END gameboard -->

<script type="text/javascript">
    // Javascript HTML templates
    // Define templates for dynamic elements here, using variables from your JavaScript file
</script>

{OVERALL_GAME_FOOTER}