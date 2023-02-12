<?php 
  //démarer la session
  session_start();
?>
<!DOCTYPE html>
<head>
   
    <title>Connexion | Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
</head>

<body>
     <?php

    @$valider = $_POST["button_con"];
    @$email = $_POST["email"];
    @$password=  $_POST["mdp1"];

    






        if(isset($_POST['button_inscription'])){
        
           include "connexion_bdd.php";
        
           extract($_POST);
        
           if(isset($email) && isset($mdp1) && $email != "" && $mdp1 != "" && isset($mdp2) && $mdp2 != ""){
               //verifions que les mots de passes sont conforme
               if($mdp2 != $mdp1){
                   
                   $error = "Les Mots de passes sont differents !";
               }else {
            
                   $req = mysqli_query($con , "SELECT * FROM utilisateurs WHERE email = '$email'");
                   if(mysqli_num_rows($req) == 0){
                       //si ca n'existe pas  creons le compte
                       $req = mysqli_query($con , "INSERT INTO utilisateurs VALUES (NULL, '$email' , '$mdp1') ");
                       if($req){

                           $_SESSION['message'] = "<p class='message_inscription'>Votre compte a ete creer avec succès !</p>" ;
                        
                           header("Location:index.php") ;
                           
                       }else {
                         
                           echo $error = "Inscription Echouee !";
                       }
                      
                   }else {
                      
                       echo $error = "Cet Email existe deja !";
                   }

               }
           }else {
              echo  $error = "Veuillez remplir tous les champs !" ;
           }
        }



        
     ?>

<style>
         *{
            font-family:arial;
         }
         body{
            margin:20px;
         }
         input{
            border:solid 1px #2222AA;
            margin-bottom:10px;
            padding:16px;
            outline:none;
            border-radius:6px;
         }
         .erreur{
            color:#CC0000;
            margin-bottom:10px;
         }
      </style>

      <form action="" method="POST" class="form_connexion_inscription" >
        <h1>INSCRIPTION</h1>
        
        <input type="email" name="email" placeholder ="email" > <br/>
        <input type="password" name="mdp1" placeholder ="password"  class="mdp1"> <br/>
        <input type="password" name="mdp2" placeholder ="Confirmation" class="mdp2"> <br/>
        <input type="submit" value="Inscription" name="button_inscription"> <br/>
        <p class="link">Vous avez un compte ? <a href="index.php">Se connecter</a></p>
    </form>

    
    
</body>
</html>