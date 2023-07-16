<?php
session_start();
require ('ajax/inc/header.php');
?>
<main class="question">
<div class="container">
    <center>
        <h2>Questions :</h2>
        <hr>
    </center>
    <center>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
        Ajouter un nouveau sujet 
        </button>
    </center>
    <br><br>
    <!-- Modal pour add-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nouveau sujet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Titre:</label>
                            <input for="message-text" class="col-form-label" type="text" name="title" id="title" autocomplete="off"/>
                            <label id="lblTitle" style="color:red" ></label>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Description:</label>
                            <textarea class="form-control" name="descrip" id="descrip" type="text"></textarea>
                            <label id="lblDescrip" style="color:red" ></label>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Contenu:</label>
                            <textarea class="form-control" name="content" id="content"></textarea>
                            <label id="lblContent" style="color:red" ></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary" id="save">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <?php 
            $select = "SELECT * FROM questions ORDER BY id DESC";
            $result = mysqli_query($con,$select);
            $i = 0;
            while($rows = mysqli_fetch_array($result)){
                $i++;
                $id = $rows["id"];
                $title = $rows["title"];
                $description = $rows["description"];
                $content = $rows["content"];
                $id_autor = $rows["id_autor"];
                $pseudo_autor = $rows["pseudo_autor"];
                $date_publi  = $rows["date_publi"];
        ?>
        <div class="card text-center" style="border: solid">
            <div class="card-header">
                <!-- on affiche le titre -->
                <h3><?= $title;?></h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <!-- on affiche le pseudo -->
                    Publié par <?= $pseudo_autor ;?>
                </h5>
                <p class="card-text">
                    <?= $description;?>
                </p>
                <a href="#" class="btn btn-primary">Accéder à l'article</a>
                <?php 
                // remplacer $_SESSION['id'] == 9 par le super admin 
                    if ($_SESSION['id'] == $id_autor || $_SESSION['id'] == 9) {
                ?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success edit_data" id="<?php echo $id; ?>">
                    Modifier l'article
                    </button>
                    <button type="button" class="btn btn-warning del_data" id="<?php echo $id; ?>">
                    Supprimer l'article
                    </button>
                <?php
                }
                ?>
            </div>
            <hr>
            <div class="card-footer text-muted">
                <?= $date_publi;?>
            </div>
        </div>
    <br>
        <?php 
            }
        ?>
    </div>

    <!-- EDIT Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" id="updateForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier le sujet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body" id="update_details">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary" id="update">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- DELETE Modal -->
    <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" method="POST" id="deleteForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Supprimer la discussion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body" id="delete_details">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary" id="delete">Supprimer </button>
                    </div>
                </form>
            </div>
        </div>

    </div> <!-- la fin de la div -->
</div>
</main>
<?php
    require('ajax/inc/footer.php');
?>
<!-- NAME = title = lblTitle
     AGE = descrip = lblDescrip
     CITY = content = lblContent
-->

<script>
    // il permet d'ajouter de nouvelle publication, et renvoie vers le fichier save_data pour 
    // transférer les données dans la bdd et show un msg si il a pas entré de donnée
    $(document).ready(function(){
        $(document).on('click','#save',function(){
            var title = $("#title").val();
            var descrip = $("#descrip").val();
            var content = $("#content").val();

            if(title == ""){
                // $("#lblTitle".html("Entrez un titre"));
                var div_contenu = document.getElementById("lblTitle");
                div_contenu.innerHTML = "Entrez un titre";
                
            }else if(descrip == ""){
                var descContenu = document.getElementById("lblDescrip");
                descContenu.innerHTML = "Entrez une description";
            }else if(content == ""){
                var contentContenu = document.getElementById("lblContent");
                contentContenu.innerHTML = "Entrez le contenu";
            }else{
                $.ajax({
                    url:"actions/ajax/save_data.php",
                    type:"post",
                    data:{title:title, descrip:descrip, content:content},
                    success:function(data){
                        alert("Bien joué, c'est posté");
                        $("#addModal").modal("hide");
                        location.reload();
                    }
                });
            }
        });
    });

    // Edit part
    // update_details
    // editModal
    $(document).on('click','.edit_data',function(){
        var edit_id = $(this).attr('id');
        $.ajax({
            url:"actions/ajax/edit_data.php",
            type:"post",
            data:{edit_id:edit_id},
            success:function(data){
                var div_contenu = document.getElementById("update_details");
                div_contenu.innerHTML = data;
                $("#editModal").modal("show");
            }
        });
    });

    // Update part
    $(document).on('click','#update',function(){
        $.ajax({
            url:"actions/ajax/update_data.php",
            type:"post",
            data:$('#updateForm').serialize(),
            success:function(data){
                alert("Tkt tous a été modif !");
                $("#editModal").modal("hide");
                location.reload();
            }
        });
    });

    // Delete view part => avant de supp
    $(document).on('click','.del_data',function(){
        var del_id = $(this).attr('id');
        $.ajax({
            url:"actions/ajax/delView_data.php",
            type:"post",
            data:{del_id:del_id },
            success:function(data){
                var div_contenu = document.getElementById("delete_details");
                div_contenu.innerHTML = data;
                $("#delModal").modal("show");
            }
        });
    });

    // Delete part
    $(document).on('click','#delete',function(){
        $.ajax({
            url:"actions/ajax/delete.php",
            type:"post",
            data:$('#deleteForm').serialize(),
            success:function(data){
                alert("Tkt c'est supprimé !");
                $("#delModal").modal("hide");
                location.reload();
            }
        });
    });
    
</script>






 