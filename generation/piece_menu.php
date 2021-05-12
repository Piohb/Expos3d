<?php require("../views/head.html"); ?>
<body class="piece_menu">

<header role="banner">
    <h1 class="title_create">Choisissez votre mode de création</h1>
    <!-- STEPS -->
</header>
<?php require("../views/menu.php"); ?>
    <div class="container">

        <div class="container-align">
        <div class="card_menu">
            <a class="a-null" href="piece.php">
                    <div class="face face1">
                        <div class="content">
                            <img src="https://github.com/Jhonierpc/WebDevelopment/blob/master/CSS%20Card%20Hover%20Effects/img/design_128.png?raw=true">
                            <h3>Plan 2D</h3>
                        </div>
                    </div>
                    <div class="face face2">
                        <div class="content">
                            <p>Générez et personnalisez votre environnement 3D à l’aide d'une grille</p>
                        </div>
                    </div>
                </div>
            </a>
                <div class="card_menu">
                    <a class="a-null" href="piece_SVG.php">
                        <div class="face face1">
                            <div class="content">
                                <img src="../assets/img/svg.png">
                                <h3>Fichier SVG</h3>
                            </div>
                        </div>
                        <div class="face face2">
                            <div class="content">
                                <p>Mettez en ligne votre fichier SVG et ajouter des oeuvres</p>
                            </div>
                        </div>
                    </a>
                </div>


                </div>


            <div class="logo_footer_container">
                <img id="logo_footer_piece" src="../assets/img/logo-dark.svg">
            </div>

    </div>


    <!-- JS -->
    <script type="text/javascript" src="../scripts/upload.js"></script>
    <script>
        $(document).ready(function(){

            var clicks = 0;

            $('#next').click(function() {
                if (clicks == 0){
                         $("#steps2").show();
                         document.getElementById("steps2").scrollIntoView();
                } else{
                         $("#steps3").show();
                         document.getElementById("steps3").scrollIntoView();
                }
                ++clicks;
            });
        });
    </script>
</body>
</html>