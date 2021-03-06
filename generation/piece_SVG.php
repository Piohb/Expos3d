<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>EXPOS3D Générer l'exposition</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/stylesheets/style.css">
    

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script>
    <script src="../scripts/gestionOeuvres.js"></script>
    <script src="../scripts/mursOnLoad.js"></script>
    <script src="../scripts/mursSVG.js"></script>
    <script src="../scripts/mursPlan2d.js"></script>
    
    <script src="https://aframe.io/releases/1.0.0/aframe.min.js"> </script>
    <script src="https://cdn.jsdelivr.net/gh/donmccurdy/aframe-extras@v6.1.0/dist/aframe-extras.min.js"></script>
    <script src="https://cdn.rawgit.com/donmccurdy/aframe-physics-system/v4.0.1/dist/aframe-physics-system.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.4.1/snap.svg-min.js"></script>
    <script src="https://unpkg.com/aframe-look-at-component@0.8.0/dist/aframe-look-at-component.min.js"></script> 
    
</head>
<style>
    table{
        border-collapse: collapse;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-user-drag: none;
        -webkit-touch-callout: none;
        width: 100%;
        height: 540px;
    }
    
    td{
        border: 1px solid rgb(209, 209, 209);
        text-align: center;
        color: white;
        max-width: 0;
        line-height: 0;
    }

    a-scene{
        width: 100%;
        height: 540px;
        border: 1px solid black;
    }

    #steps2{
        display: none;
        margin-top: 8em;
    }

    #steps3{
        display: none;
        margin-top: 8em;
    }

</style>
<body>
<header role="banner">
    <h1 class="title_create">créer une exposition</h1>
    <h2 class="soustitle_create">Ajouter un fichier SVG et ajouter des oeuvres</h2>
</header>
<?php require("../views/menu.php"); ?>
<main>

    <div class="container">

    <section id="steps1">

        <div class="generation">


            <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                  <div class="toast-body">
                  Hello, world! This is a toast message.
                 </div>
                  <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
              </div>

            <div class="row">

                <div class="col-sm-3 col-12  mb-4">
                <input type="text" style="display: none; opacity: 0" id="btnAjoutOeuvre">
                <input type="text" style="display: none; opacity: 0" id="btnSupprimerOeuvre">
                </div>


            </div>
            
            <div class="row ">
                <div class="col-xl-5">
                        <div class="blc-gauche">
                            <div>
                                <label for="txtNomExpo">Nom de l'exposition</label>
                                <input type="text" class="search" id="txtNomExpo"  name="txtNomExpo">
                                <label for="txtDescriptionExpo">Description de l'exposition</label>
                                <textarea class="form-control" id="txtDescriptionExpo" name="txtDescriptionExpo" rows="3"></textarea>
                            </div>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                      <strong>FICHIER SVG</strong>
                                    </button>
                                  </h2>
                                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                     
                                        <table id="table" style="display: none;">
        
                                        </table>

                                        <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
                                        <div class="file-upload">
                                          <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Ajouter une image</button>
                                        
                                          <div class="image-upload-wrap">
                                            <input class="file-upload-input" id="upload" type='file' onchange="readURL(this);" />
                                            <br />
                                            
                                            <div class="drag-text">
                                              <h3>Glisser et déposer un fichier</h3>
                                            </div>
                                          </div>
                                          <img src="" id="imgsvg" style="max-height:600px;"/>
                                          <div class="file-upload-content">
                                            <img class="file-upload-image" src="#" alt="your image" />
                                            <div class="image-title-wrap">
                                              <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                            </div>
                                          </div>
                                        </div>
            
                                    </div>
                                  </div>
                                </div>
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <strong style="text-transform: uppercase;">Liste d’oeuvres existente</strong> 
                                    </button>
                                  </h2>
                                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                        <div class="row">
                                            <div class="col-12">
                        
                                                <label for="search_oeuvre">chercher une oeuvre </label>
                                                <input type="text" class="search" id="search_oeuvre"  name="search_oeuvre">
                        
                                            </div>
                                        </div>
                        
                        
                        
                                        <div class="row oeuvre_sroll">
                                            <div class="col-12">
                        
                                                <div class="col" id="divAcordeonOeuvres">

                                                </div>
                        
                                            </div>

                                            
                                        </div>
                        
                        
                                        <div id="divControlesOeuvres">
                    
                                        </div>
                        
                                        <div id="divrechercheOeuvres">
                    
                                        </div>
                                        <input class="btn btn-primary" type="button" id="btnremplacer" value="Mettre les modèles" />


                                    </div>
                                  </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <strong style="text-transform: uppercase;">AJOUTer une oeuvre</strong>
                                      </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                      <div class="accordion-body">
                                        <form action="" method="get">
    
    
                                            <div class="row">
                        
                                            
                                                <div class="col-md-6">
                        
                                                    <p class="mt-4">* champs obligatoires</p>
                        
                                                    <div class="grp_oeuvre">
                                                        <input type="file" name="uploadOeuvre" id="uploadOeuvre" />
                                                        <div class="spinner-grow text-danger" id="spinner-danger" role="status" style="display: none;">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    </div>
                        
                                                </div>
                        
                        
                                            </div>
                        
                                        </form>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading4">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                        <strong style="text-transform: uppercase;">modification oeuvres</strong>
                                      </button>
                                    </h2>
                                    <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
                                      <div class="accordion-body">
                                        <div class="oeuvre">
                                            <div class="oeuvre_txt">
                                                Titre : <input type="text" id="txttitre" placeholder="Titre...">
                                                Description : <textarea name="description" id="txtdescription" cols="10" rows="2" placeholder="Description..."></textarea>
                                                <button type="button" id="btninfosoeuvre" class="btn btn-primary" aria-label="Valider">Valider</button>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading5">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                        <strong style="text-transform: uppercase;">Modifier emplacement</strong> 
                                      </button>
                                    </h2>
                                    <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample">
                                      <div class="accordion-body">
                                      <div>
                                            <div class="row mb-3">
                                                <div class="col-4">
                                                    <label for="posx">Position X </label>
                                                    <input id="posx" type="number" name="scalx" class="form-control" step="0.1" onchange="modifierPosition(parseFloat(document.querySelector('#posx').value), 'x')">
                                                </div>
                                                <div class="col-4">
                                                    <label for="posy">Position Y </label>
                                                    <input id="posy" type="number" name="scaly" class="form-control" step="0.1" onchange="modifierPosition(parseFloat(document.querySelector('#posy').value), 'y')">
                                                </div>
                                                <div class="col-4">
                                                    <label for="posz">Position Z </label>
                                                    <input id="posz" type="number" name="scalz" class="form-control" step="0.1" onchange="modifierPosition(parseFloat(document.querySelector('#posz').value), 'z')">
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-4">
                                                    <label for="rotx">Rotation X </label>
                                                    <input id="rotx" type="number" name="rotx" class="form-control" step="0.1" onchange="modifierRotation(parseFloat(document.querySelector('#rotx').value), 'x')">
                                                </div>
                                                <div class="col-4">
                                                    <label for="roty">Rotation Y </label>
                                                    <input id="roty" type="number" name="roty" class="form-control" step="0.1" onchange="modifierRotation(parseFloat(document.querySelector('#roty').value), 'y')">
                                                </div>
                                                <div class="col-4">
                                                    <label for="rotz">Rotation Z </label>
                                                    <input id="rotz" type="number" name="rotz" class="form-control" step="0.1" onchange="modifierRotation(parseFloat(document.querySelector('#rotz').value), 'z')">
                                                </div>
                                            </div>
                                            <label for="scal" class="mt-5">Scale</label>
                                            <input id="scal" type="number" name="scalx" class="form-control" step="0.01" max="10" onchange="modifierScale(parseFloat(document.querySelector('#scal').value))">
                                            <br /><br />
                                            <input type="file" id="fileSon" />
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                            </div>

                        </div>

                </div>
                
                <div class="col-xl-7">
                    <div class="blc-droite">
                        <div>
                            
                            <div class="spinner-border" id="spinner" style="display:none" role="status">
                                <span class="visually-hidden">Loading...</span>
                              </div>
                              
                            <a-scene physics="debug: true" id="scene" cursor="rayOrigin: cursor" embedded>
                                <a-entity id="camera" position="0 1.6 0">
                                    <a-entity camera wasd-controls="acceleration: 300; fly: true" look-controls="pointerLockEnabled: true"><!--kinematic-body="radius:0.5"-->
                                        <a-cursor raycaster="interval: 500" id="cursor" geometry="primitive: ring; radiusInner: 0.001; radiusOuter: 0.005" material="color: #000000; shader: flat"></a-cursor>
                                    </a-entity>
                                </a-entity>
                    
                                <!--<a-box color="blue" id="b1" width="1.5" depth="1" height="3" static-body>
                                    <a-plane id="e1" visible="false" text="value: Hello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello World; font: mozillavr; baseline: bottom; align:center; anchor: center" position="-2 1 0" width="2" height="2" shadow="receive: false" look-at="[camera]" color="red">
                                    </a-plane>
                                </a-box>-->
                                <a-grid material="src:https://cdn.jsdelivr.net/gh/donmccurdy/aframe-extras@v1.16.3/assets/grid.png; repeat: 500 500" width="500" height="500" position="0 0 0" static-body rotation="-90 0 0"></a-grid>
                                <a-sky src="../assets/26229014269_dac746757d_k.jpg" position="0 1800 0"></a-sky>
                                
                            </a-scene>
                        </div>
                    </div>
                        
                    <div style="text-align:center;margin-bottom: 4em;">
                            <button type="button" id="btnfinal" class="btn btn-primary btn-lg next" aria-label="Choix des oeuvres de l'exposition">ENREGISTER</button>
                            <!-- <input type="button" id="btnfinal" value="BOUTON EXPORT"> -->
                            <a href="../visit/expositions.php" style="display: contents;"><button type="button" class="btn btn-primary btn-lg next" aria-label="Choix des oeuvres de l'exposition">VOIR LES EXPOS</button></a>
                    </div>

                </div>

            </div>

        
        </div>

        </section>

    
    </div>
</main>


    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" src="../scripts/upload.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


    
</body>
</html>