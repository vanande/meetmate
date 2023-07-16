<?php
include('includes/connect.php');
?>

<!DOCTYPE html>
<?php include('includes/header.php');?>
<body>
<?php include ('includes/navHome.php');?>

<section>
    <img src="assets\img\gm1.jpg" id="gm1">
</section>

<script src="assets/bootstrap/js/bootstrap.js"></script>

<section class="login-dark-2">

    <form action="actions/friendAction.php" method="POST">
        <?php include("includes/message.php") ?>

        <div class="form-floating mb-3">
            <input type="text" name="receive" class="form-control" id="floatingInput" placeholder="Pseudo">
            <label for="floatingInput">Pseudo</label>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-block w-100" type="submit" name="validate">Ajouter</button>
        </div>
    </form>
    <form action="actions/friendAns.php" method="POST">
        <table class="table mb-3 table-secondary">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Envoyer</th>
                <th scope="col">Reçoie</th>
                <th scope="col">Statut</th>
                <th scope="col">Réponse</th>
            </tr>
            </thead>
            <tbody>

            <?php

            $idSend = $_SESSION['id'];
            $q = $db->prepare("SELECT * FROM `relation` WHERE send = ? OR receive = ?");
            $q->execute([$idSend, $idSend]);
            $relation = $q->fetchAll();
            $row = $q->rowCount();

            if ($row == 0){
                echo '<td colspan="6" class ="table-warning">Vous n\'avez pas d\'amis =( </td>';
            }


            for ($i = 0 ; $i < $row ; $i++){

                $q = $db->prepare("SELECT pseudo FROM `users` WHERE id= ? ");
                $q->execute([$relation[$i][0]]);
                $send = $q->fetchAll();

                $q = $db->prepare("SELECT pseudo FROM `users` WHERE id= ? ");
                $q->execute([$relation[$i][1]]);
                $receive = $q->fetchAll();

                $statut = $relation[$i][2]==0? 'En attente' : 'Validé';

                echo '<tr>
                          <th scope="row">' . $i . '</th>
                          <td>' . $send[0][0] . '</td>
                          <input type="text" name="send-' . $i . '" class="visually-hidden" value=" ' .$send[0][0]. '">
                          <input type="text" name="idSend-' . $i . '" class="visually-hidden" value=" ' .$relation[$i][0]. '">
                          <td>' . $receive[0][0] . '</td>
                          <input type="text" name="receive-' . $i . '" class="visually-hidden" value=" ' .$receive[0][0]. '">
                          <input type="text" name="idReceive-' . $i . '" class="visually-hidden" value=" ' .$relation[$i][1]. '">
                          <td>' . $statut . '</td>';
                if($_SESSION['pseudo'] == $receive[0][0] && $relation[$i][2] == 0){
                    echo  '<td>
                            <input name="accept-' . $i . '" class="btn btn-success" type="submit" value="Accepter">
                          </td>
                          <td>
                            <input name="refuse-' . $i . '" class="btn btn-danger" type="submit" value="Refuser">
                          </td>
                        </tr>';
                } else if ($_SESSION['pseudo'] == $receive[0][0] && ($relation[$i][2] == 1 || $relation[$i][2] == 2)) {
                    echo  '
                          <td>
                            <input name="sendMsg-' . $i . '" class="btn btn-success" type="button" value="Envoyez un message">
                          </td>
                          <td>
                            <input name="delete-' . $i . '" class="btn btn-danger" type="submit" value="Supprimez">
                          </td>
                        </tr>';
                }
            }
            ?>
            </tbody>
        </table>
    </form>
</section>
</body>
</html>
