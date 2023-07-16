<!DOCTYPE html>
<?php
    require('actions/securityAction.php');
    // on importe le header
    include "includes/header.php";
    include "includes/navHome.php";

    include ('includes/db.php');

    $q = "SELECT avatar FROM users WHERE id = ? ";
    $req = $db->prepare($q);
    $res = $req->execute([$_SESSION['id']]);
    $avatar = $req->fetch();
    $avatar = $avatar[0]; // array -> str

    $q = "SELECT description FROM users WHERE id = ? ";
    $req = $db->prepare($q);
    $res = $req->execute([$_SESSION['id']]);
    $description = $req->fetch();
    $description = $description[0]; // array -> str


?>

<body class="profil">
    <div class="wrapper">
        <div class="container mt-4">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="box p-4 bg-dark" id="box-profil">
                        <h1>AVATAR</h1>
                        <img src="<?= !empty($avatar) ? 'actions/uploads/profil_image/'.$avatar : 'assets/img/perso.jpg' ?>" class="img-thumbnail " alt="">
                        <br>
                        <a href="modifyProfil.php?id=<?=$_SESSION['id']?>&f=modifyImage" class="btn btn-primary">MODIFIER</a>
                        <input type="button" onclick="easterEgg()" value="Make an avatar">

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box p-4 bg-dark" id="box-profil">
                        <h1>INFOS :</h1>
                        <p>NOM : <?php echo $_SESSION['nickname']; ?></p>
                        <p>PSEUDO : <?php echo $_SESSION['pseudo']; ?></p>
                        <p>EMAIL : <?php echo $_SESSION['email']; ?></p>
                        <a href="modifyProfil.php?id=<?=$_SESSION['id']?>&f=modifyInfos" class="btn btn-primary">MODIFIER</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box p-4 bg-dark "id="box-profil">
                        <h1>Description</h1>
                        <?php include("includes/message.php") ?>
                        <p>
                        	<?php
                        		if (isset($description)) {
                        			echo ' ' . $description . ' ' ;
                        		}else{
                        			echo 'Vous n\'avez encore rien écrit... ';
                        		}

                        	?>
                        </p>
                        <a href="modifyProfil.php?id=<?=$_SESSION['id']?>&f=modifyDescription" class="btn btn-primary">Modifier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.js"></script>
    <script>
        let count;
        function easterEgg(){
             count++;
            console.log(count);
            if (count > 3){
                document.body.style.backgroundImage = "url('actions/uploads/image-1650819024.jpg')";
            }
        }
    </script>
</body>
