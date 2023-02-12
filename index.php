
<?php 
  //demarer la session
  session_start();
?>
<!DOCTYPE html>

<head>
    
    <title>Connexion | Chat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
</head>
<body>
    <?php 

  $error = "";


    @$valider = $_POST["button_con"];
    @$email = $_POST["email"];
    @$password=  $_POST["password1"];
       if(isset($valider)){
           //si le formulaire est envoye
           //se connecter a la base de donnee
           include "connexion_bdd.php"; 


           


           //verifions si les champs sont vides
           if(isset($email) && isset($password) && $email != "" && $password != ""){
               //verifions si les identifiants sont justes ou equivalent
               $verification = mysqli_query($con , "SELECT * FROM utilisateurs WHERE email = '$email' AND mdp = '$password'");


               if(mysqli_num_rows($verification) > 0){
                   //si les ids sont justes
                   //Creation d'une session qui contient l'email
                   $_SESSION['user'] = $email ;
                   //redirection vesr la page chat
                   header("location:chat.php");
                   // detruire la variable du message d'inscription
                   unset($_SESSION['message']);
               }
               
               else {
                   //si non
                   echo $error = "Email ou Mots de passe incorrecte(s) !";
                  
               }
           }
           
           else {
               //si les champs sont vides
               echo $error = "Veuillez remplir tous les champs !" ;
            
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
         .error{
            color:#CC0000;
            margin-bottom:10px;
         }
         a{
            font-size:12pt;
            color:#EE6600;
            text-decoration:none;
            font-weight:normal;
         }
         a:hover{
            text-decoration:underline;
         }



      </style>

    <form action=""  method="POST" class="form_connexion_inscription">
        <h1>CONNEXION</h1>
        <label>Adresse Mail</label>
        <input type="email" name="email" value="<?php echo @$email   ?>" >
        <div class="error"><php echo $error ?></div>
        <label>Mots de passe</label>
        <input type="password" name="password1"  value="<?php echo @$password   ?>" >
        <input type="submit" value="Connexion" name="button_con">
        <p class="link">Vous n'avez pas de compte ? <a href="inscription.php">Creer un compte</a></p>
    </form>
    
</body>
</html>