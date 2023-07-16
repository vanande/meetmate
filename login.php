<?php
    require("actions/loginAction.php");
?>
<!DOCTYPE html>
    <?php include("includes/header.php");?>


<body class="login">
    <?php include('includes/navHome.php') ?>
    <section class="login-dark">
        <form method="post">
            <h2 class="visually-hidden">Login Form</h2>

            <!-- Si y avait une erreur à l'inscription, bah elle va s'afficher la -->
                <?php if(isset($errorMsg)){ 
                    echo '<p>'.$errorMsg.'</p>'; }
                ?>
            </div>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="mb-3">
                <input class="form-control" type="text" name="pseudo" placeholder="Pseudo">
            </div>
            <div class="mb-3">
                <input class="form-control" type="password" name="pass" placeholder="Mot de passe">
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-block w-100" type="submit" name="validate">Se Connecter</button>
            </div>
            <a class="forgot" href="#">Vous avez oubliez votre mot de passe?</a>
            <a class="forgot" href="signUp.php"><p>Je n'ai pas de compte,</p></a>
        </form>
    </section>

    <section>
    <img src="assets\img\gm1.jpg" id="gm1">
    </section>
    <script src="assets/bootstrap/js/bootstrap.js"></script>
</body>

</html>