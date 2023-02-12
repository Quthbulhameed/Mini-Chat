

            <?php 
            session_start();
            if(isset($_SESSION['user'])){// si l'utilisateur s'est connecte
               //connexion a la abse de donnee
               include "connexion_bdd.php";


               
               
               //requete pour afficher les messages
               $req = mysqli_query($con , "SELECT * FROM messages ORDER BY id_m");
               if(mysqli_num_rows($req) == 0){
                   // s'il n'y a pas encore de message
                   echo "Messagerie vide";
               }else {
                   //si oui
                   while($row= mysqli_fetch_assoc($req)){
                       //si c'est vous qui avvez envoye le mesage on utilise ce format :
                        if($row['email'] == $_SESSION['user']){
                            ?>
                                <div class="message your_message">
                                    <span>Me</span>
                                    <p><?=$row['msg']?></p>
                                    <p class="date"><?=$row['date']?></p>
                                </div>
                            <?php
                        }else {
                            //si vous n'etes pas l'auteur du message , on affiche ce message sur ce format :
                                ?>
                                     <div class="message others_message">
                                        <span><?=$row['email']?></span>
                                        <p><?=$row['msg']?> </p>
                                        <p class="date"><?=$row['date']?></p>
                                    </div>
                                <?php
                        }
                   } 
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
         a{
            color:#EE6600;
            text-decoration:none;
         }
         a:hover{
            text-decoration:underline;

         }

      </style>
              
              
              
             
               