<?php 
// On inclut la connexion à la base de données
    require_once 'config.php'; 

    // Si les variables existent et qu'elles ne sont pas vides
   if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype']))
    {
        // Patch XSS
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);

        // On vérifie si l'utilisateur existe
        $check = $bdd->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();
        // Ici on transforme l'email en minuscule au cas où il soit en majuscule
        $email = strtolower($email); 
        
        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
        if($row == 0){ 
            // On vérifie que la longueur du pseudo et du mail soit de 50 (car sur le script c'est VARCHAR50)
            if(strlen($pseudo) <= 50){ 
                if(strlen($email) <= 50){ 
                    // Si le mail est de forme valide
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){ 
                        // Si les deux mots de passe sont corrects
                        if($password === $password_retype){ 

                            // On hash le mot de passe avec Bcrypt, via un coût de 12
                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                            

                            // On insère dans la base de données
                            $insert = $bdd->prepare('INSERT INTO utilisateurs(pseudo, email, password) VALUES(:pseudo, :email, :password)');
                            $insert->execute(array(
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'password' => $password
                              ));
                            // On redirige avec le message de succès
                            header('Location:inscription.php?reg_err=success');
                            die();
                        }else{ header('Location: inscription.php?reg_err=password'); die();}
                    }else{ header('Location: inscription.php?reg_err=email'); die();}
                }else{ header('Location: inscription.php?reg_err=email_length'); die();}
            }else{ header('Location: inscription.php?reg_err=pseudo_length'); die();}
        }else{ header('Location: inscription.php?reg_err=already'); die();}
    }