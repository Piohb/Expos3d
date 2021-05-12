<?php session_start(); ?>
<nav id="Menu" class="container z-5 m-sm-0" role="navigation" aria-label="Menu">

    <div id="blur" class="mobile display d-lg-none">
        <img src="http://89.234.180.61/plesk-site-preview/expos3d.fr/https/89.234.180.61/assets/img/logo-dark.svg" alt="logo">
    </div>

    <button class="menuBurger d-flex z-10" aria-expanded="true" aria-controls="menu-principal">
        <span class="line"></span>
        <span class="line"></span>
    </button>

    <div class="userMenu row pt-0">
        <div class="d-flex justify-content-end">
            <a <?php if(isset($_SESSION["User"])){echo("href='http://89.234.180.61/plesk-site-preview/expos3d.fr/https/89.234.180.61/scripts/deconnexion.php'");}else{echo("href='http://89.234.180.61/plesk-site-preview/expos3d.fr/https/89.234.180.61/formulaires/inscription.php'");}?>class='d-flex'>
            <?php
                if(isset($_SESSION["User"]))
                {
                    echo($_SESSION["User"]);
                }
                else
                {
                    echo("Connexion / Inscription");
                }
            ?>
                <img src="http://89.234.180.61/plesk-site-preview/expos3d.fr/https/89.234.180.61/assets/img/user.svg" class="bicon ms-3" alt="user">
            </a>
        </div>
    </div>

    <div class="navMenu row">
        <ul class="m-0 p-0">
        <li><a href="http://89.234.180.61/plesk-site-preview/expos3d.fr/https/89.234.180.61/index.php" title="accueil">Accueil</a></li>
        <?php
            if(isset($_SESSION["User"]))
            {
                echo("<li><a href='http://89.234.180.61/plesk-site-preview/expos3d.fr/https/89.234.180.61/generation/piece_menu.php' title='créer son expo'>créer son expo</a></li>");
            }
        ?>
            <li><a href="http://89.234.180.61/plesk-site-preview/expos3d.fr/https/89.234.180.61/visit/expositions.php" title="voir les expos">voir les expos</a></li>
        </ul>
    </div>

    <div class="dropdownMenu row">
        <div>
            <a data-bs-toggle="collapse" href="#Tutorial" role="button" aria-expanded="true" aria-controls="Tutorial">
                Tutoriel <img src="http://89.234.180.61/plesk-site-preview/expos3d.fr/https/89.234.180.61/assets/img/arrow.svg" class="smicon" alt="dropdown">
            </a>
        </div>

        <div class="collapse show" id="Tutorial">
            <div class="card card-body">

                <div id="carouselTutorial" class="carousel slide" data-bs-interval="false" data-bs-ride="false">
                    <div class="carousel-inner">

                        <div class="carousel-btn">
                            <button class="carousel-control-prev no-btn" href="#carouselTutorial" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>

                            <button class="carousel-control-next no-btn" href="#carouselTutorial" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <div class="carousel-item active">

                            <div class="carousel-card">
                                <div class="carousel-image" style="background-image: url('http://89.234.180.61/plesk-site-preview/expos3d.fr/https/89.234.180.61/assets/img/clavier.JPG')"></div>
                            </div>

                            <div class="carousel-caption">
                                <h5>Déplacement</h5>
                                <p>Utiliser les touches ZQSD ou les flèches directionnelles pour vous déplacer</p>
                            </div>
                        </div>

                        <div class="carousel-item">

                            <div class="carousel-card">
                                <div class="carousel-image" style="background-image: url('http://89.234.180.61/plesk-site-preview/expos3d.fr/https/89.234.180.61/assets/img/ajouter_oeuvre.JPG')"></div>
                            </div>

                            <div class="carousel-caption">
                                <h5>Ajouter une oeuvre</h5>
                                <p>Ajouter des oeuvres à votre environnement en utilisant notre banque d'oeuvre</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="contactMenu row" role="contentinfo">
        <a href="#" title="Nous contacter">contact</a>

        <div>
            <a href="#" class="cs" title="politique de confidentialité">politique de confidentialité</a>
            <a href="#" class="cs" title="documents annexes">documents annexes</a>
        </div>

        <p>Développé par <br><a href="#">©Expos3d</a></p>
    </footer>
</nav>
<script src="http://89.234.180.61/plesk-site-preview/expos3d.fr/https/89.234.180.61/assets/scripts/animate.js"></script>