<?php

$connexion_string = "mysql:dbname=wp-test-board;host=127.0.0.1;charset=utf8";

$login = "root";

$mdp = "rastaman66";












function openBDD()
{
    global $connexion_string;
    global $login;
    global $mdp;
    $bdd = new PDO($connexion_string, $login, $mdp);
    return $bdd;
}
