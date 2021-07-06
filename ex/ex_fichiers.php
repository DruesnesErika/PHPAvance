<?php
// On met les types autorisés dans un tableau (ici pour une image)
$aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");

// On ouvre l'extension FILE_INFO
$finfo = finfo_open(FILEINFO_MIME_TYPE);

// On extrait le type MIME du fichier via l'extension FILE_INFO 
$mimetype = finfo_file($finfo, $_FILES["fichier"]["tmp_name"]);

// On ferme l'utilisation de FILE_INFO 
finfo_close($finfo);

if (in_array($mimetype, $aMimeTypes))
{
    /* Le type est parmi ceux autorisés, donc OK, on va pouvoir 
       déplacer et renommer le fichier */          
} 
else 
{
   // Le type n'est pas autorisé, donc ERREUR

   echo "Type de fichier non autorisé";    
   exit;
}    
move_uploaded_file($_FILES["fichier"]["tmp_name"], "images/photo.jpg");  
$extension = pathinfo($_POST["fichier"]["tmp_name"], PATHINFO_EXTENSION); 
?>
<form action="post.php" method="post" enctype="multipart/form-data">
<input type="file" name="fichier"> 