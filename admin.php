<?php
include('includes/connect.php');
?>

<!DOCTYPE html>
<?php include('includes/header.php');?>

<body class="container-fluid">

<?php include ('includes/navHome.php');?>

    <!-- img src="assets\img\gm1.jpg" id="gm1" -->

<script src="assets/bootstrap/js/bootstrap.js"></script>

<section class="login-dark-2">



    <form action="actions/adminAction.php" method="POST">
        <?php include("includes/message.php") ?>
        <div class="admin-table">
            
        <table class="admin-table table table-striped table-bordered table-sm table-dark">
            <thead>
            <tr>
                <th class="th-sm" scope="col">#</th>
                <th class="th-sm" scope="col">Liste des modérateurs</th>
                <th class="th-sm" scope="col">ID</th>
                <th class="th-sm" scope="colgroup"></th>
            </tr>
            </thead>
            <tbody>

            <?php

            $q = $db->prepare("SELECT id,pseudo,roles FROM `users` WHERE roles = ? || roles = ?");
            $q->execute([1, 2]);
            $admin = $q->fetchAll();
            $row = $q->rowCount();

            for ($i = 0 ; $i < $row ; $i++){

                echo '<tr>
                          <th class="th-sm" scope="row">' . $i . '</th>
                          <td>' . $admin[$i][1] . '</td>
                          <input type="text" name="user-' . $i . '" class="visually-hidden" value="' . $admin[$i][1] . ' ">
                          <td>' . $admin[$i][0] . '</td>
                          <input type="text" name="idUser-' . $i . '" class="visually-hidden" value="' . $admin[$i][0] . ' ">
                          ';

                if($_SESSION['roles'] > $admin[$i][2] ){
                    echo  '
                          <td>
                            <input name="demote-' . $i . '" class="btn btn-danger" type="submit" value="Demote">
                          </td>
                        </tr>';
                }
            }
            ?>
            </tbody>
        </table>
        </div>
    </form>


    
        <div class="admin-table">
        <table class="admin-table table table-striped table-bordered table-sm table-dark">
            <thead>
            <tr>
                <th class="th-sm" scope="col">#</th>
                <th class="th-sm" scope="col">Liste</th>
                <th class="th-sm" scope="col">des</th>
                <th class="th-sm" scope="col">utilisateurs</th>
                <th class="th-sm" scope="col">Roles</th>
                <th class="th-sm" scope="col">ID</th>
                <th class="th-sm" scope="col"></th>
                <th class="th-sm" scope="col"></th>
            </tr>
            </thead>
            <tbody>

            <?php

            $q = $db->prepare("SELECT id,pseudo,nickname,email,roles FROM `users` ");
            $q->execute();
            $users = $q->fetchAll();
            
            $row = $q->rowCount();

            for ($i = 0 ; $i < $row ; $i++){

                echo '<tr>
                          <th class="th-sm" scope="row">' . $i . '</th>
                <form action="actions/adminAction.php" method="POST">
                          <td>' . $users[$i][1] . '</td>
                          <input type="text" name="user-' . $i . '" class="visually-hidden" value="' . $users[$i][1] . '">
                          <td>' . $users[$i][2] . '</td>
                          <td>' . $users[$i][3] . '</td>
                          <td>' . $users[$i][4] . '</td>
                          <td>' . $users[$i][0] . '</td>
                          <input type="text" name="idUser-' . $i . '" class="visually-hidden" value="' . $users[$i][0] . '">
                          ';

                if($_SESSION['roles'] > $users[$i][4] && $users[$i][4] == 0){
                    echo '<td>
                            <input name="promote-' . $i . '" class="btn btn-success" type="submit" value="Promote">
                          </td>
                          <td>
                            <input name="delete-' . $i . '" class="btn btn-danger" type="submit" value="Delete">
                          </td>
                        </form></tr>'
                        ;
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>
