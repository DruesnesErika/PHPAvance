<?php 
// On démarre la session
    session_start(); 
// On inclut la base de données
    require_once 'config.php'; 
// On vérifie que l'email et le mot de passe existent et qu'ils ne sont pas vides
    if(!empty($_POST['email']) && !empty($_POST['password'])) 
    {
// Patch XSS
        $email = htmlspecialchars($_POST['email']); 
        $password = htmlspecialchars($_POST['password']);
// Ici on transforme l'email en minuscule au cas où il soit en majuscule
        $email = strtolower($email); 
        
// On vérifie si l'utilisateur est inscrit dans la table utilisateurs
        $check = $bdd->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();
        
        

        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
        {
            // Si le mail est bon niveau format
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                // Si le mot de passe est le bon
                if(password_verify($password, $data['password']))
                {
                    // On créer la session et on redirige sur landing.php
                    $_SESSION['user'] = $data['pseudo'];
                    header('Location: landing.php');
                    die();
                }else{ header('Location: index.php?login_err=password'); die(); }
            }else{ header('Location: index.php?login_err=email'); die(); }
        }else{ header('Location: index.php?login_err=already'); die(); }
// Si le formulaire est envoyé sans aucune données dans ce cas là on redirige vers index.php
    }else{ header('Location: index.php'); die();} 