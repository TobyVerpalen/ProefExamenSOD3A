<?php
session_start();
require_once 'Database.php';
require_once 'classVotedpage.php';

$db = new Database();
$votedPage = new VotedPage($db);
$votedPage->displaySelectedCandidate();
?>
