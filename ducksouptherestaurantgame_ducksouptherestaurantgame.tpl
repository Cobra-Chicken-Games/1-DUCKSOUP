{OVERALL_GAME_HEADER}
<!-- BEGIN gameboard -->
<div class="game-board">
<!-- END gameboard -->
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
                                            <img class="left" src="/img/duckats.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="player-background player_${PLAYER_COLOR}"></div>
                    </div>

                    <!-- STAFF BOARD -->
                </div>
            </div>

            <!-- LEFT CONTENT -->
            <div class="left-content">
                    <!-- DUCK IMAGE TO DISPLAY BY DEFAULT, HIDDEN WHEN CONTENT SHOWN -->

                    <!-- WRITTEN CONTENT SHOWN IN MIDDLE OF BOARD, INACTIVE BY DEFAULT -->
                    <div class="board-contents active">
                        <h2>${BOARD_TITLE}</h2>
                        <p>${BOARD_TEXT}</p>
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
