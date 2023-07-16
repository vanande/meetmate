<?php
    
    require("includes/connect.php"); //on se connecte a la bdd et on demarre la session
    //on va faire une verification du formulaire s'il est remplie ou non avant l'include
    if(isset($_POST["validate"])){

        if (isset($_POST["pseudo"]) && isset($_POST["nickname"]) && isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["pass2"]) 
        && !empty($_POST["pseudo"]) && !empty($_POST["nickname"]) && !empty($_POST["email"]) && !empty($_POST["pass"]) && !empty($_POST["pass2"])
        && ($_POST["pass"] == $_POST["pass2"]) && isset($_POST['case'])
        ) {
            
            // on sait que tous est remplie

            $user_pseudo = strip_tags($_POST["pseudo"]);
            $user_nickname = strip_tags($_POST["nickname"]);

            // verification de l'email, même si bootstrap le fait déjà
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                die("Le mail n'est pas correcte");
            }
            // on va encrypter / hash le mdp
            $pass = password_hash($_POST["pass"], PASSWORD_ARGON2I);
            $pass2 = password_hash($_POST["pass2"], PASSWORD_ARGON2I);
            

            //AJOUTEZ LES CONTROLES
            $checkIfUserExist = $db->prepare('SELECT pseudo FROM users WHERE pseudo = ?');
            $checkIfUserExist->execute(array($user_pseudo));
            
            if ($checkIfUserExist->rowCount() == 0) {

                //on insert dans la bdd les infos
                $inserUser = $db->prepare("INSERT INTO `users` (`pseudo`,`nickname`, `email`,`pass`, `roles`) VALUES (?,?, ?, ?, ?)");
                $inserUser->execute(array($user_pseudo, $user_nickname , $_POST["email"], $pass, 0));

                //on recupere les infos de l'user
                $infoOfUser = $db->prepare('SELECT `id` , `pseudo` , `nickname` , `email` FROM `users` WHERE pseudo = ? AND nickname = ? AND email = ?');
                $infoOfUser->execute(array($user_pseudo,$user_nickname,$_POST["email"]));

                //on stocke les infos sous forme d'un tableau
                $information = $infoOfUser->fetch();

                //on l'authentifie sur le site et tte les infos stockées dans les variables globales
                $_SESSION['authentified'] = true;
                $_SESSION['id'] = $information['id'];
                $_SESSION['pseudo'] = $information['pseudo'];
                $_SESSION['nickname'] = $information['nickname'];
                $_SESSION['email'] = $information['email'];
                $_SESSION['roles'] = $information['roles'];


		$topic = "Compte crée";
		$message = "Votre compte MeetMate a été créer avec succès";
		$recipient = $information['email'];
		include('PHPMailer.php');

                header("Location: profil.php");
            }else {
                $errorMsg = ("L'utilisateur existe déjà sur le site");
            }

        }
        else {
            $errorMsg = ("Veuillez bien complèter le formulaire !");
        
        }
    }
