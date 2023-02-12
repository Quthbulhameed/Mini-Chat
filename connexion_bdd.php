

<?php 
    //Connexion  a la base de donnees
    $con = mysqli_connect("localhost","root","root","mini_chat");
    if(!$con){
        //si la connexion echoue , afficher :
        echo "Connexion échouee";
    }


?>