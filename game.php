<?php
include('includes/connect.php');
?>

<!DOCTYPE html>
<?php include('includes/header.php');?>
<body class="container-fluid">

<script>
    function search(){
        // Get input.value
        const research = document.getElementById('search').value;
        console.log(research);


        // Instance ajax object
        const request = new XMLHttpRequest();
        request.open('GET', 'getsearch.php?research='+research, false);
        request.onreadystatechange = function (){
            if (request.readyState === 4){
                var response = request.responseText; // coded json
                response = JSON.parse(response); //decoded json
                console.log(response);


                var tbodyContainer = document.createElement("tbody");
                //parcourir le tableau de  resultat
                for (var i = 0 ; i < response.length ; i++) {

                    //create tr
                    var tr = document.createElement("tr");

                    //create td - id
                    var td = document.createElement("td");
                    td.innerHTML = response[i][0];
                    tr.appendChild(td);


                    //create td - type
                    var td = document.createElement("td");
                    td.innerHTML = response[i][2];
                    tr.appendChild(td);


                    //create td - nom
                    var td = document.createElement("td");
                    td.innerHTML = response[i][1];
                    tr.appendChild(td);


                    //create td - image
                    var td = document.createElement("td");
                    td.innerHTML = "<img src='actions/uploads/game_image/"+response[i][3]+"' height='100px' />";
                    tr.appendChild(td);


                    //create td - description
                    var td = document.createElement("td");
                    td.innerHTML = response[i][4];
                    tr.appendChild(td);

                    tbodyContainer.appendChild(tr);

                }

                var tbody = document.getElementById("tbody");
                tbody.innerHTML = tbodyContainer.innerHTML;

            // fin
            }
        };
    request.send();
    }


</script>

<?php include ('includes/navHome.php');?>

    <!-- img src="assets\img\gm1.jpg" id="gm1" -->

<script src="assets/bootstrap/js/bootstrap.js"></script>

<section class="login-dark-2 login-dark-3">

    <div class="input-group search-bar-ajax">
        <a href="addGame.php"><button value="Ajouter un jeu" class="btn btn-info">Ajouter un jeu</button></a>

        <input type="search" id="search" oninput="search()" class="form-control rounded ajax-input " placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
        <button type="button" class="btn btn-outline-primary">search</button>
    </div>

    <form action="modifyGame.php" method="POST">
        <?php include("includes/message.php") ?>

        <div class="game-table">
            
        <table class="admin-table table table-striped table-bordered table-xl table-dark">
            <thead>
            <tr>
                <th class="th-sm" scope="col">#</th>
                <th class="th-sm" scope="col">Type de jeu</th>
                <th class="th-sm" scope="col">Nom du jeu</th>
                <th class="th-sm" scope="col">Image du jeu</th>
                <th class="th-sm" scope="col">Description</th>
                <th class="th-sm" scope="col"></th>
            </tr>
            </thead>
            <tbody id="tbody">

            <?php

            $q = $db->prepare("SELECT game_name, game_type, game_image, game_description FROM `games`");
            $q->execute();
            $game = $q->fetchAll();
            $row = $q->rowCount();

            for ($i = 0 ; $i < $row ; $i++){

            $q = 'SELECT game_image, game_id FROM games WHERE game_name = "' . $game[$i][0] . '"';
            $req = $db->query($q);

            $result = $req->fetch(); // Récupérer la première ligne de résultat;
            $imageName = $result['game_image'];
            $fullPath = 'actions/uploads/game_image/' . $imageName;




                echo '<tr>
                          <th class="th-sm" scope="row">' . $result[1] . '</th>
                          
                          
                          
                          <td><div class="text-center">' . $game[$i][1] . '</div>';

                          if($_SESSION['roles'] ==  1 || $_SESSION['roles'] ==  2) {
                              echo '<input name="modifyType-' . $result[1] . '" class="btn btn-info" type="submit" value="Modifier"></td>
                          <input type="text" name="game_type-' . $result[1] . '" class="visually-hidden" value="' . $game[$i][1] . '">
                          ';
                          }


                          echo'<td><div class="text-center">' . $game[$i][0] . '</div>';
                           if($_SESSION['roles'] ==  1 || $_SESSION['roles'] ==  2){
                          echo '<input name="modifyName-' .$result[1] . '" class="btn btn-info" type="submit" value="Modifier"></td>
                          <input type="text" name="game_name-' . $result[1] . '" class="visually-hidden" value="' . $game[$i][0] . '">
                          ';
                            }
                          
                          echo'<td><img height="200px"  id="game_image" src=" ' . $fullPath . '" alt="Image de ' . $game[$i][0]. '"><input name="modifyImage-' . $result[1] . '" class="btn btn-info" type="submit" value="Modifier"></td>
                          <input type="text" name="game_image-' . $result[1] . '" class="visually-hidden" value="' . $imageName . '">
                          
                          
                          <td>' . $game[$i][3] . '<input name="modifyDescription-' . $result[1] . '" class="btn btn-info" type="submit" value="Modifier"></td>
                          <input type="text" name="game_description-' . $result[1] . '" class="visually-hidden" value="' . $game[$i][3] . '">
                          
                          
                          <td><input type="submit" value="Delete" name="delete-'. $result[1] . '" class="btn btn-danger"></td>
                          
                          ';

                if($_SESSION['roles'] ==  1 || $_SESSION['roles'] ==  2){
                    echo  '
                          <td>
                            <input name="modify-' . $result[1] . '" class="visually-hidden" type="submit" value="Modifier">
                          </td>
                        </tr>';
                }
            }
            ?>
            </tbody>
        </table>
        </div>
    </form>

</section>

</body>
</html>
