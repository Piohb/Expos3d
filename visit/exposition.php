<?php 

if(isset($_GET['id'])){
    $servername = "localhost:3306";
    $username = "user";
    $password = "tBr78n_4";
    $dbname = "db_expos3d";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT nom, codeExposition FROM exposition WHERE idExposition = $_GET[id]";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        if($row = $result->fetch_assoc()) {
            $json = $row['codeExposition'];
        }
    }
    $conn->close();
}
?>

<html>
    <header>
        <!-- Scripts -->
        <script src="../scripts/visiter.js"> </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script>
        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../assets/stylesheets/style.css">
        <script src="https://aframe.io/releases/1.0.0/aframe.min.js"> </script>
        <script src="https://cdn.jsdelivr.net/gh/donmccurdy/aframe-extras@v6.1.0/dist/aframe-extras.min.js"></script>
        <script src="https://cdn.rawgit.com/donmccurdy/aframe-physics-system/v4.0.1/dist/aframe-physics-system.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.4.1/snap.svg-min.js"></script>
        <script src="https://unpkg.com/aframe-look-at-component@0.8.0/dist/aframe-look-at-component.min.js"></script> 
        <style>
            body {
                margin : 0px;
                padding : 0px;
                background-color: black;
                color: white;
            }
        </style>
    </header>

    <body>
    <div class="spinner-border" id="spinner" style="display:block; position: absolute; left: 49%; top: 50%" role="status">
        
    </div>
    <progress id="waitingBar" style="display:block; position: absolute; left: 45%; top: 55%; width: 10%" value="0"></progress>
    <span id="waitingText" style="display:block; position: absolute; left: 44%; top: 60%"></span>
    
    <a-scene id="scene" style="opacity: 0" cursor="rayOrigin: cursor" embedded>
        <a-entity id="camera" position="0 1.6 0">
            <a-entity camera wasd-controls="acceleration: 250;" look-controls="pointerLockEnabled: true" kinematic-body="radius:0.5">
                <a-cursor raycaster="interval: 500" id="cursor" geometry="primitive: ring; radiusInner: 0.001; radiusOuter: 0.005" material="color: #000000; shader: flat"></a-cursor>
            </a-entity>
        </a-entity>

        <!--<a-box color="blue" id="b1" width="1.5" depth="1" height="3" static-body>
            <a-plane id="e1" visible="false" text="value: Hello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello WorldHello World; font: mozillavr; baseline: bottom; align:center; anchor: center" position="-2 1 0" width="2" height="2" shadow="receive: false" look-at="[camera]" color="red">
            </a-plane>
        </a-box>-->
        <a-grid material="src:../assets/img/planks_spruce.png; repeat: 500 500" width="500" height="500" position="0 0 0" static-body rotation="-90 0 0"></a-grid>

        <a-box material="src:../assets/img/ciel2.png; repeat: 500 500" width="10000" height="10000" position="0 75 0" static-body rotation="-90 0 0"></a-grid>
    </a-scene>
    </body>
</html>

<script>
    let json = <?php echo $json; ?>;
    let oeuvresCount = 0;
    let oeuvresLoadedCount = 0;
    
    console.log({json});
    let scene = document.querySelector("#scene");
    json.murs.forEach(mur => {
        let box = document.createElement("a-box");
        box.setAttribute("id", mur.id);
        box.setAttribute("position", {
            x : mur.position.x,
            y : mur.position.y,
            z : mur.position.z
        });
        box.setAttribute("rotation", {
            x : mur.rotation.x,
            y : mur.rotation.y,
            z : mur.rotation.z
        });
        box.setAttribute("height", mur.height);
        box.setAttribute("width", mur.width);
        box.setAttribute("depth", mur.depth);
        box.setAttribute("static-body", "");
        box.setAttribute("color", mur.color);
        scene.appendChild(box);
    });
    json.cylindres.forEach(cylindre => {
        let cyl = document.createElement("a-cylinder");
        cyl.setAttribute("height", cylindre.height);
        cyl.setAttribute("radius", cylindre.radius);
        cyl.setAttribute("color", cylindre.color);
        cyl.setAttribute("shadow", "");
        cyl.setAttribute("geometry", {
            segmentsRadial: 6,
        });
        cyl.setAttribute("static-body", "");
        cyl.setAttribute("position", {
            x: cylindre.position.x,
            y: cylindre.position.y,
            z: cylindre.position.z,
        });
        scene.appendChild(cyl);
    });
    json.oeuvres.forEach(item => {
        oeuvresCount = oeuvresCount + 1;
        let oeuvre = document.createElement("a-gltf-model");
        oeuvre.setAttribute("id", item.id);
        oeuvre.setAttribute("static-body", "");
        oeuvre.setAttribute("scale", {
            x: item.scale.x,
            y: item.scale.y,
            z: item.scale.z
        });
        oeuvre.setAttribute("position", {
            x: item.position.x,
            y: item.position.y,
            z: item.position.z
        });
        oeuvre.setAttribute("rotation", {
            x: item.rotation.x,
            y: item.rotation.y,
            z: item.rotation.z
        });
        oeuvre.setAttribute("src", item.src);
        scene.appendChild(oeuvre);
        document.querySelector("#" + item.id).addEventListener("model-loaded", () => {
            oeuvresLoadedCount = oeuvresLoadedCount + 1;
            document.querySelector("#waitingText").innerText = "Modèle(s) chargé(s) : " + oeuvresLoadedCount + " / " + oeuvresCount;
            document.querySelector("#waitingBar").value = oeuvresLoadedCount * 100;
            if(oeuvresCount === oeuvresLoadedCount){
                document.querySelector("#spinner").style.display = "none";
                document.querySelector("#waitingBar").style.display = "none";
                document.querySelector("#waitingText").style.display = "none";
                document.querySelector("#scene").style.opacity = 1;
            }
        });
    });
    document.querySelector("#waitingText").innerText = "Modèle(s) chargé(s) : " + oeuvresLoadedCount + " / " + oeuvresCount;
    document.querySelector("#waitingBar").max = oeuvresCount * 100;
    json.texts.forEach(text => {
        let t = document.createElement("a-text");
        t.setAttribute("id", text.id);
        t.setAttribute("position", {
            x : text.position.x,
            y : text.position.y,
            z : text.position.z
        });
        t.setAttribute("look-at", "[camera]");
        t.setAttribute("font", text.font);
        t.setAttribute("value", text.value);
        t.setAttribute("color", text.color);
        scene.appendChild(t);
    });
</script>