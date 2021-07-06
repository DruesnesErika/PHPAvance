<?php
session_start();

$_SESSION["login"] = "webmaster";

echo $_SESSION["login"];

session_start();

$_SESSION["login"] = "webmaster";
$_SESSION["role"] = "admin";

echo"- session ID : ".session_id();



session_start();

if ($_SESSION["login"]) 
{
   echo"Vous êtes autorisé à voir cette page.";  
} 
else 
{
   echo"Cette page nécessite une identification.";  
}


session_start();

if ( ! isset($_SESSION["login"]) ) 
{
    header("Location:index.php");
    exit;
}

// Reste du code (PHP/HTML)
echo"Bonjour ".$_SESSION["login"]."<br>");  