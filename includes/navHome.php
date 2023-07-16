<!--Slide Navigation for home-->
<header>
		<span class="toggle-button"> <!--Hamburger Buton-->
        	<div class="menu-bar menu-bar-top"></div>
        	<div class="menu-bar menu-bar-middle"></div>
        	<div class="menu-bar menu-bar-bottom"></div>
        </span>
    <div class="menu-wrap">
        <div class="menu-sidebar">
            <ul class="menu">
                <!-- Pour afficher la barre de nav en fonction de la connexion -->
                <?php if (!isset($_SESSION['authentified'])): ?>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="login.php">Connecter</a></li>
                    <li><a href="signUp.php">S'inscrire</a></li>

                <?php else: ?>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="FriendList.php">Liste d'amis</a></li>
                    <li><a href="questions.php">Questions</a></li>
                    <li><a href="group.php">Groupe</a></li>
                    <li><a href="tournament.php">Tournoi</a></li>
                    <li><a href="game.php">Consulter les jeux</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <?php if($_SESSION['roles'] == 1 || $_SESSION['roles'] == 2 ){
                        
                        echo '<li><a href="admin.php">Modérations</a></li>';
                        //echo '<li><a href="group.php">Gérer les groupes (en cours)</a></li>';
                        //echo '<li><a href="tournament.php">Gérer les tournois (en cours)</a></li>';
                    }
                        ?>
                    

                    <li><a href="actions/logout.php">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>


