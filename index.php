<?php require("views/head.html"); ?>
<body class="index">
<?php require("views/menu.php"); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r119/three.min.js"></script>
    <script src="https://cdn.rawgit.com/mrdoob/three.js/master/examples/js/loaders/GLTFLoader.js"></script>

    <main class="container" role="main">

        <div class="brow row">
            <header role="banner">
                <img src="assets/img/logo.svg" alt="logo">
                <h1 class="text-center">Créez vos salons 3D !</h1>
            </header>

            <section class="frame row">
                <div class="frameRow mt-xl-2">
                    <div class="frameCard active card ms-0 ms-md-2 ms-lg-3" data-model="0"></div>
                    <div class="frameCard card" data-model="1"></div>
                    <div class="frameCard card" data-model="2"></div>
                    <div class="frameCard card me-0 me-md-2 me-lg-3" data-model="3"></div>
                </div>
                <div class="frameRow">
                    <div class="frameCard card ms-0 ms-md-2 ms-lg-3" data-model="4"></div>
                    <div class="frameCard card" data-model="5"></div>
                    <div class="frameCard card" data-model="6"></div>
                    <div class="frameCard card me-0 me-md-2 me-lg-3" data-model="7"></div>
                </div>
            </section>
        </div>

        <section class="presentation row">
            <h2 class="text-end mb-4">Customisable à volonté</h2>
            <p class="text-end mb-5">Facile et rapide d'utilisation, Expos3d vous offre la possibilité de modeler vos propres structures sans connaissance particulière requise. Vous pourrez ainsi y ajouter autant de modèles 3D que vous le souhaitez. Pour les plus experts, la génération via fichier SVG est disponible.</p>
        </section>
    </main>

    <!-- JS -->
    <script type="module" src="assets/scripts/home.js"></script>

</body>
</html>