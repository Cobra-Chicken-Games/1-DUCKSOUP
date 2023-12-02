
-- ------
-- BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
-- DuckSoupTheRestaurantGame implementation : © <Your name here> <Your email address here>
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-- -----

-- dbmodel.sql

-- This is the file where you are describing the database schema of your game
-- Basically, you just have to export from PhpMyAdmin your table structure and copy/paste
-- this export here.
-- Note that the database itself and the standard tables ("global", "stats", "gamelog" and "player") are
-- already created and must not be created here

-- Note: The database schema is created from this file when the game starts. If you modify this file,
--       you have to restart a game to see your changes in database.

-- Example 1: create a standard "card" table to be used with the "Deck" tools (see example game "hearts"):

-- CREATE TABLE IF NOT EXISTS `card` (
--   `card_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
--   `card_type` varchar(16) NOT NULL,
--   `card_type_arg` int(11) NOT NULL,
--   `card_location` varchar(16) NOT NULL,
--   `card_location_arg` int(11) NOT NULL,
--   PRIMARY KEY (`card_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- Example 2: add a custom field to the standard "player" table
-- ALTER TABLE `player` ADD `player_my_custom_field` INT UNSIGNED NOT NULL DEFAULT '0';

-- Create a database named ducksoupdb
-- CREATE DATABASE IF NOT EXISTS ducksoupdb;
-- USE ducksoupdb;

-- Table for players
CREATE TABLE players (
    player_id INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_name VARCHAR(255),
    duckats_balance INT,
    souper_duckats_balance INT,
    is_on_vacation BOOLEAN DEFAULT FALSE
);

-- Table for staff
CREATE TABLE staff (
    staff_id INT AUTO_INCREMENT PRIMARY KEY,
    staff_type VARCHAR(255),
    staff_role VARCHAR(255),
    staff_value INT,
    is_excellent BOOLEAN
);

-- Table for staff board of each player
CREATE TABLE staff_board (
    board_id INT AUTO_INCREMENT PRIMARY KEY,
    player_id INT,
    staff_id INT,
    FOREIGN KEY (player_id) REFERENCES players(player_id),
    FOREIGN KEY (staff_id) REFERENCES staff(staff_id)
);

-- Table for questions
CREATE TABLE questions (
    question_id INT AUTO_INCREMENT PRIMARY KEY,
    question_text TEXT,
    answer_a TEXT,
    answer_b TEXT,
    answer_c TEXT,
    answer_d TEXT,
    correct_answer CHAR(1),
    duckat_value INT
);

-- Table for restaurant cards
CREATE TABLE restaurant_cards (
    card_id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    effect TEXT
);

-- Table for transactions (Duckats and Souper Duckats movements)
CREATE TABLE transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    player_id INT,
    transaction_type VARCHAR(255),
    amount INT,
    FOREIGN KEY (player_id) REFERENCES players(player_id)
);