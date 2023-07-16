<?php
    require('actions/signupAction.php');
    include ("includes/header.php");
?>


<body>
    <div class="fake">
        <div class="row register-form">
            <div class="col-md-8 offset-md-2">
                <form class="custom-form" method="post">
                    <h1>Inscription</h1>
                    <!-- Si y avait une erreur à l'inscription, bah elle va s'afficher la -->
                    <?php
                    if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; }?>
                    <div class="row form-group">
                        <!-- PSEUDO -->
                        <div class="col-sm-4 label-column">
                            <label class="col-form-label" for="name-input-field">Pseudo </label>
                        </div>
                        <div class="col-sm-6 input-column">
                            <input class="form-control" type="text" name="pseudo" id="pseudo" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <!-- NOM -->
                        <div class="col-sm-4 label-column">
                            <label class="col-form-label" for="name-input-field">Nom </label>
                        </div>
                        <div class="col-sm-6 input-column">
                            <input class="form-control" type="text" name="nickname" id="nickname" autocomplete="off"/>
                        </div>
                    </div>
                    <!-- EMAIL -->
                    <div class="row form-group">
                        <div class="col-sm-4 label-column">
                            <label class="col-form-label" for="email-input-field">Email </label>
                        </div>
                        <div class="col-sm-6 input-column">
                            <input class="form-control" type="email" name="email" id="email" />
                        </div>
                    </div>
                    <!-- MOT DE PASSE -->
                    <div class="row form-group">
                        <div class="col-sm-4 label-column">
                            <label class="col-form-label" for="pawssword-input-field" >Mot de passe </label>
                        </div>
                        <div class="col-sm-6 input-column">
                            <input class="form-control" type="password" name="pass" id="pass"/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 label-column">
                            <label class="col-form-label" for="repeat-pawssword-input-field" >Vérification mot de passe </label>
                        </div>
                        <div class="col-sm-6 input-column">
                            <input class="form-control" type="password" name="pass2" id="pass2"/>
                        </div>
                    </div>
                    <!-- SEXE -->
                    <div class="row form-group">
                        <div class="col-sm-4 label-column">
                            <label class="col-form-label" for="dropdown-input-field">Sexe </label>
                        </div>
                        <div class="col-sm-4 input-column">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Choisir</option>
                                <option value="1">Homme</option>
                                <option value="2">Femme</option>
                                <option value="3">Ne préfère pas préciser</option>
                            </select>
                        </div>
                    </div>
                    <!-- CHECK -->
                    <div class="form-check">
                        <input id="formCheck-1" class="form-check-input" type="checkbox" name="case" id="case"/>
                        <label class="form-check-label" for="formCheck-1">J'ai lu et accepte les termes d'utilisation</label>
                    </div>
                    <button class="btn btn-light submit-button" type="submit" name="validate">S'incrire</button>
                    <a href="login.php"><p>J'ai déjà un compte,</p></a>

                    <div id="board"></div>
                    
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/captcha.js"></script>
    <script src="assets/bootstrap/js/bootstrap.js"></script>

</body>

</html>