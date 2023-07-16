<?php
    require("includes/connect.php"); //on se connecte a la bdd et on demarre la session

    $try = 'Tentative de connexion';
    include('includes/log.php');

    //on va faire une verification du formulaire s'il est remplie ou non avant l'include
    if(isset($_POST["validate"])){

        if (!empty($_POST["pseudo"]) && !empty($_POST["pass"])
        ) {
            // on sait que tous est remplie

            $user_pseudo = strip_tags($_POST["pseudo"]);

            // on va enregistrer le mdp
            $user_Pass = htmlspecialchars($_POST["pass"]);

            //on verifie si l'utilisateur existe
            $ifUserExist = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
            $ifUserExist->execute(array($user_pseudo));

            if ($ifUserExist->rowCount() > 0) {
                $information = $ifUserExist->fetch();
                if(password_verify($user_Pass, $information['pass'])){
                    
                    //on l'authentifie sur le site et tte les infos stockées dans les variables globales
                    $_SESSION['authentified'] = true;
                    $_SESSION['id'] = $information['id'];
                    $_SESSION['pseudo'] = $information['pseudo'];
                    $_SESSION['nickname'] = $information['nickname'];
                    $_SESSION['email'] = $information['email'];
                    $_SESSION['roles'] = $information['roles'];

                    /*  $_SESSION['user'] = $information;
                    $_SESSION['user']['auth'] = true;
                    $_SESSION['user']['roles']; */

                    writeLogLine($try, true, $_SESSION['email']);
                    header("Location: profil.php");

                }else {
                    $errorMsg = ('Votre mdp est incorrecte');
                    writeLogLine($try, false , $_POST['email']);
                }

            }else {
                $errorMsg = ('Votre pseudo est incorrecte !');
                writeLogLine($try, false , $_POST['pseudo']);
            }
        }
        else {
            $errorMsg = ("Veuillez bien complèter le formulaire !");
            writeLogLine($try, false , $_POST['pseudo']);
        }
        }