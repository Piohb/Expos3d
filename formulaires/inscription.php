<?php  require("../views/head.html"); ?>
<body class="connexion">
<?php require("../views/menu.php"); ?>

<div class="container">
    <header role="banner">
        <h1 class="title_create">Inscription / Connexion</h1>
    </header>

    <div class="row">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6 offset-md-1 offset-lg-2 offset-xl-3">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="signup" data-bs-toggle="tab" data-bs-target="#inscription" type="button" role="tab" aria-controls="inscription" aria-selected="true">Inscription</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="signin" data-bs-toggle="tab" data-bs-target="#connexion" type="button" role="tab" aria-controls="connexion" aria-selected="false">Connexion</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="inscription" role="tabpanel" aria-labelledby="signup">

                    <form method="POST" action="../scripts/creationCompte.php">
                        <div class="form-row">
                            <input type="email" class="form-field" name="txtEmail" id="txtEmail" placeholder="Votre mail" required/>
                            <label for="txtEmail" class="form-label">Email</label>
                        </div>
                        <div class="form-row">
                            <input type="text" class="form-field" name="txtUsername" id="txtUsername" placeholder="Pseudo" required autocomplete="off" />
                            <label for="txtUsername" class="form-label">Pseudo</label>
                        </div>
                        <div class="form-row pwd">
                            <input type="password" class="form-field" name="txtPassword" id="txtPassword" placeholder="Mot de passe" required />
                            <label for="txtPassword" class="form-label">Mot de passe</label>
                        </div>
                        <div class="form-row pwd">
                            <input type="password" class="form-field" name="txtVerifPassword" id="txtVerifPassword" placeholder="Mot de passe" required />
                            <label for="txtVerifPassword" class="form-label">A vérifier</label>
                        </div>

                        <div class="form-row pwd">
                            <button role="button">S'inscrire</button>
                        </div>
                    </form>

                </div>

                <div class="tab-pane fade" id="connexion" role="tabpanel" aria-labelledby="signin">

                    <form method="POST" action="../scripts/connexion.php">
                        <div class="form-row">
                            <input type="text" class="form-field" name="txtPseudo" id="txtPseudo" placeholder="Pseudo" required autocomplete="off"/>
                            <label for="txtPseudo" class="form-label">Pseudo</label>
                        </div>

                        <div class="form-row">
                            <input type="password" class="form-field" name="txtMdp" id="txtMdp" placeholder="Mot de passe" required />
                            <label for="txtMdp" class="form-label">Mot de passe</label>
                        </div>

                        <div class="form-row pwd">
                            <button role="button">Se connecter</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>



<?php require("../views/scripts.html"); ?>
</body>
</html>
