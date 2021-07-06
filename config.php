<?php
try 
{
    //Instanciation de la connexion à la base
    $bdd = new PDO("mysql:host=localhost;charset=utf8;dbname=jarditou", "root", ""); 
}
catch(PDOException $e)
{
    die('Erreur : '.$e->getMessage());
}