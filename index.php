<?php
    // import header and nav-home
    session_start();
    include "includes/header.php";
    include "includes/navHome.php";
?>
	
<section class="acc">
    
    <img src="assets\img\star.png" id="star">
    <img src="assets\img\moon.png" id="moon">
    <img src="assets\img\mountain.png" id="mountain">
    <img src="assets\img\tree.png" id="tree">
    <img src="assets\img\room.png" id="room">
    <h2 id="NAMEHEAD">Meet Mate</h2>
    <a href="signUp.php"id="btn">Découvrir</a>
        
    </section>

    <div class="box" id="go-down">
        <div class="container">
            <div class=row>

                <div class=col-sm>
                    <div id="box1">
                        <H4 id="stitre">Le But</H4>
                        <p id= "txt" >Notre équipe a décidé de révolutionner l'avenir du gaming en créant from scratch tout les supports nécessaires aux joueurs/joueuses pour leur permettre de jouer ensemble, même sur des jeux solos. Le site Meetmate permet aux gamers du monde entier de se retrouver sur un seul et même site et ainsi passer de gamer triste et solitaire à la limite du suicide à un gamer heureux avec un entourage chaleureux.</p>
                        <img src="assets\img\rt.jpg" class="img-fluid" alt="Responsive image">
                    </div>
                </div>

                <div class=col-sm>
                    <div id="box1">
                        <H4 id="stitre">Comment ?</H4>
                        <p id= "txt">La mise en relation des joueurs et joueuses du monde entier nécessite un travail colossal. Notre équipe travail d'arrache-pied pour mettre au point un système sans pareil au même niveau que Facebook ou Twitter à la seule différence que nous ne collectons pas toutes vos données pour les revendre à des particuliers. À la place nous préférons travailler sur la création d'un nouveau réseau social réservé aux gamers de tous les pays (mais surtout en France pour le moment)</p>
                        <img src="assets\img\izuku.png" class="img-fluid" alt="Responsive image">
                    </div>
                </div>

                <div class=col-sm>
                    <div id="box1">
                        <H4 id="stitre">Pour qui ?</H4>
                        <p id= "txt">Meetmate est avant tout un choix que l'on offre aux joueurs. Les personnes qui en bénéficieront le plus seront les joueurs voulant sortir de leur misérable solitude pour pouvoir s'amuser de nouveau avec des frères/sœurs de jeux qui les accompagneront toutes aux longs de leur longue session sur GTA V ou Minecraft par exemple. La réunion des particuliers permet la création d'une force nouvelle réunissant tous les individus volontaires. </p>
                        <img src="assets\img\detective.jpg" class="img-fluid" alt="Responsive image">
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script>
        let star = document.getElementById('star');
        let mountain = document.getElementById('mountain');
        let moon = document.getElementById('moon');
        let tree = document.getElementById('tree');
        let room = document.getElementById('room');
        let text = document.getElementById('text');
        let btn = document.getElementById('btn');
        let poteau = document.getElementById('poteau');

        window.addEventListener('scroll', function(){
            let value = window.scrollY;
            star.style.right = value * 0.25 + 'px';
            moon.style.top = value * 0.5 + 'px';
            tree.style.top = value * 0.30 + 'px';
            mountain.style.top = value * 0.15  + 'px';
            text.style.marginTop = value * 1.3 + 'px';
            btn.style.marginTop = value * 1.3 + 'px';

        })

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.js"></script>

    <!-- Import footer -->
    <?php 
        include "includes/footer.php";
    ?>