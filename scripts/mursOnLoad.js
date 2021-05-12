let jsonExpo = {
  murs: [],
  oeuvres: [],
  cylindres: [],
  texts: []
};
window.onload = function () {

  if(document.querySelector("#btnfinalmodifier") !== null){
    document.querySelector("#btnfinalmodifier").addEventListener("click", function(){
      for(let i=0; i<document.querySelector("#scene").children.length;i++){
        if(document.querySelector("#scene").children[i].tagName.toUpperCase() === "A-GLTF-MODEL"){
          jsonExpo.oeuvres.push({
            id: document.querySelector("#scene").children[i].getAttribute("id"),
            position: {
              x: document.querySelector("#scene").children[i].getAttribute("position").x,
              y: document.querySelector("#scene").children[i].getAttribute("position").y,
              z: document.querySelector("#scene").children[i].getAttribute("position").z,
            },
            "static-body": document.querySelector("#scene").children[i].getAttribute("static-body"),
            scale: {
              x: document.querySelector("#scene").children[i].getAttribute("scale").x,
              y: document.querySelector("#scene").children[i].getAttribute("scale").y,
              z: document.querySelector("#scene").children[i].getAttribute("scale").z,
            },
            rotation: {
              x: document.querySelector("#scene").children[i].getAttribute("rotation").x,
              y: document.querySelector("#scene").children[i].getAttribute("rotation").y,
              z: document.querySelector("#scene").children[i].getAttribute("rotation").z,
            },
            src: document.querySelector("#scene").children[i].getAttribute("src")
          });
        }
        if(document.querySelector("#scene").children[i].tagName.toUpperCase() === "A-CYLINDER"){
          jsonExpo.cylindres.push({
            id: document.querySelector("#scene").children[i].getAttribute("id"),
            color: document.querySelector("#scene").children[i].getAttribute("color"),
            position: {
              x: document.querySelector("#scene").children[i].getAttribute("position").x,
              y: document.querySelector("#scene").children[i].getAttribute("position").y,
              z: document.querySelector("#scene").children[i].getAttribute("position").z,
            },
            "static-body": document.querySelector("#scene").children[i].getAttribute("static-body"),
            radius: document.querySelector("#scene").children[i].getAttribute("radius"),
            height: document.querySelector("#scene").children[i].getAttribute("height")
          });
        }
        if(document.querySelector("#scene").children[i].tagName.toUpperCase() === "A-BOX"){
          jsonExpo.murs.push({
            id: document.querySelector("#scene").children[i].getAttribute("id"),
            color: document.querySelector("#scene").children[i].getAttribute("color"),
            position: {
              x: document.querySelector("#scene").children[i].getAttribute("position").x,
              y: document.querySelector("#scene").children[i].getAttribute("position").y,
              z: document.querySelector("#scene").children[i].getAttribute("position").z,
            },
            "static-body": document.querySelector("#scene").children[i].getAttribute("static-body"),
            rotation: {
              x: document.querySelector("#scene").children[i].getAttribute("rotation").x,
              y: document.querySelector("#scene").children[i].getAttribute("rotation").y,
              z: document.querySelector("#scene").children[i].getAttribute("rotation").z,
            },
            height: document.querySelector("#scene").children[i].getAttribute("height"),
            width: document.querySelector("#scene").children[i].getAttribute("width"),
            depth: document.querySelector("#scene").children[i].getAttribute("depth")
          });
        }
        if(document.querySelector("#scene").children[i].tagName.toUpperCase() === "A-TEXT"){
          jsonExpo.texts.push({
            id: document.querySelector("#scene").children[i].getAttribute("id"),
            color: document.querySelector("#scene").children[i].getAttribute("color"),
            position: {
              x: document.querySelector("#scene").children[i].getAttribute("position").x,
              y: document.querySelector("#scene").children[i].getAttribute("position").y,
              z: document.querySelector("#scene").children[i].getAttribute("position").z,
            },
            rotation: {
              x: document.querySelector("#scene").children[i].getAttribute("rotation").x,
              y: document.querySelector("#scene").children[i].getAttribute("rotation").y,
              z: document.querySelector("#scene").children[i].getAttribute("rotation").z,
            },
            scale: {
              x: document.querySelector("#scene").children[i].getAttribute("scale").x,
              y: document.querySelector("#scene").children[i].getAttribute("scale").y,
              z: document.querySelector("#scene").children[i].getAttribute("scale").z,
            },
            value: document.querySelector("#scene").children[i].getAttribute("value"),
            font: document.querySelector("#scene").children[i].getAttribute("font")
          });
        }
      }
      let url_string = window.location.href
      let url = new URL(url_string);
      let idUrl = url.searchParams.get("id");
      const form = new FormData();
      form.append("id", idUrl);
      form.append("json", JSON.stringify(jsonExpo));
      form.append("nomExpo",document.querySelector("#txtNomExpo").value);
      form.append("descriptionExpo",document.querySelector("#txtDescriptionExpo").value);
      const request = new Request("../scripts/updateExpo.php", {
        method: "POST",
        body: form,
      });

      fetch(request).then((response) => {
        console.log(response);
        jsonOeuvres = undefined;
      });
    });
  }

  document.querySelector("#btnSupprimerOeuvre").addEventListener("click", function(){
    
    for(i=0; i<document.querySelector("#scene").children.length; i++){
      if(oeuvre.target.getAttribute("id") === document.querySelector("#scene").children[i].getAttribute("id")){
        document.querySelector("#scene").removeChild(document.querySelector("#scene").children[i]);
      }
    }
  });

  document.querySelector("#btnAjoutOeuvre").addEventListener("click", function(){
        listeEmplacements.push("");
        let oeuvre = document.createElement("a-text");
        console.log(oeuvre);
        let colors = [
            "red",
            "green",
            "blue",
            "yellow",
            "hotpink",
            "orange",
            "purple",
          ];
          oeuvre.setAttribute(
            "color",
            colors[Math.ceil(Math.random() * colors.length - 1)]
          );
        oeuvre.setAttribute("look-at", "[camera]");
        oeuvre.setAttribute("position", {
            x: document.querySelector("#camera").children[0].getAttribute("position").x,
            y: 2.5,
            z: document.querySelector("#camera").children[0].getAttribute("position").z
        });
        oeuvre.setAttribute("font", "mozillavr");
        oeuvre.setAttribute("scale", {
            x: 10,
            y: 10,
            z: 10
        });
        oeuvre.setAttribute("value", listeEmplacements.length);
        document.querySelector("#scene").appendChild(oeuvre);
  });

  chargerOeuvres();

  document.querySelector("#search_oeuvre").addEventListener("keydown", function(){
      for(i = 0; i < document.querySelector("#divAcordeonOeuvres").children.length; i++){
        if(document.querySelector("#divAcordeonOeuvres").children[i].children[0].children[0].textContent.toUpperCase().includes(document.querySelector("#search_oeuvre").value.toUpperCase())){
          document.querySelector("#divAcordeonOeuvres").children[i].style.display = "block";
        }
        else{
          document.querySelector("#divAcordeonOeuvres").children[i].style.display = "none";
        }
      }
  });

  document.querySelector("#fileSon").onchange = function() {
    const url = "../scripts/uploadSon.php";
    const form = new FormData();
    form.append("idOeuvre", clickedOeuvreId.substr(6));
    form.append("file", document.querySelector("#fileSon").files[0]);
    const request = new Request(url, {
      method: "POST",
      body: form,
    });

    fetch(request).then((response) => {
      console.log(response);
      jsonOeuvres = undefined;
    });
  }

  document.querySelector("#btnfinal").onclick = function () {
    for(let i=0; i<document.querySelector("#scene").children.length;i++){
      if(document.querySelector("#scene").children[i].tagName.toUpperCase() === "A-GLTF-MODEL"){
        jsonExpo.oeuvres.push({
          id: document.querySelector("#scene").children[i].getAttribute("id"),
          position: {
            x: document.querySelector("#scene").children[i].getAttribute("position").x,
            y: document.querySelector("#scene").children[i].getAttribute("position").y,
            z: document.querySelector("#scene").children[i].getAttribute("position").z,
          },
          "static-body": document.querySelector("#scene").children[i].getAttribute("static-body"),
          scale: {
            x: document.querySelector("#scene").children[i].getAttribute("scale").x,
            y: document.querySelector("#scene").children[i].getAttribute("scale").y,
            z: document.querySelector("#scene").children[i].getAttribute("scale").z,
          },
          rotation: {
            x: document.querySelector("#scene").children[i].getAttribute("rotation").x,
            y: document.querySelector("#scene").children[i].getAttribute("rotation").y,
            z: document.querySelector("#scene").children[i].getAttribute("rotation").z,
          },
          src: document.querySelector("#scene").children[i].getAttribute("src")
        });
      }
      if(document.querySelector("#scene").children[i].tagName.toUpperCase() === "A-CYLINDER"){
        jsonExpo.cylindres.push({
          id: document.querySelector("#scene").children[i].getAttribute("id"),
          color: document.querySelector("#scene").children[i].getAttribute("color"),
          position: {
            x: document.querySelector("#scene").children[i].getAttribute("position").x,
            y: document.querySelector("#scene").children[i].getAttribute("position").y,
            z: document.querySelector("#scene").children[i].getAttribute("position").z,
          },
          "static-body": document.querySelector("#scene").children[i].getAttribute("static-body"),
          radius: document.querySelector("#scene").children[i].getAttribute("radius"),
          height: document.querySelector("#scene").children[i].getAttribute("height")
        });
      }
      if(document.querySelector("#scene").children[i].tagName.toUpperCase() === "A-BOX"){
        jsonExpo.murs.push({
          id: document.querySelector("#scene").children[i].getAttribute("id"),
          color: document.querySelector("#scene").children[i].getAttribute("color"),
          position: {
            x: document.querySelector("#scene").children[i].getAttribute("position").x,
            y: document.querySelector("#scene").children[i].getAttribute("position").y,
            z: document.querySelector("#scene").children[i].getAttribute("position").z,
          },
          "static-body": document.querySelector("#scene").children[i].getAttribute("static-body"),
          rotation: {
            x: document.querySelector("#scene").children[i].getAttribute("rotation").x,
            y: document.querySelector("#scene").children[i].getAttribute("rotation").y,
            z: document.querySelector("#scene").children[i].getAttribute("rotation").z,
          },
          height: document.querySelector("#scene").children[i].getAttribute("height"),
          width: document.querySelector("#scene").children[i].getAttribute("width"),
          depth: document.querySelector("#scene").children[i].getAttribute("depth")
        });
      }
      if(document.querySelector("#scene").children[i].tagName.toUpperCase() === "A-TEXT"){
        jsonExpo.texts.push({
          id: document.querySelector("#scene").children[i].getAttribute("id"),
          color: document.querySelector("#scene").children[i].getAttribute("color"),
          position: {
            x: document.querySelector("#scene").children[i].getAttribute("position").x,
            y: document.querySelector("#scene").children[i].getAttribute("position").y,
            z: document.querySelector("#scene").children[i].getAttribute("position").z,
          },
          rotation: {
            x: document.querySelector("#scene").children[i].getAttribute("rotation").x,
            y: document.querySelector("#scene").children[i].getAttribute("rotation").y,
            z: document.querySelector("#scene").children[i].getAttribute("rotation").z,
          },
          scale: {
            x: document.querySelector("#scene").children[i].getAttribute("scale").x,
            y: document.querySelector("#scene").children[i].getAttribute("scale").y,
            z: document.querySelector("#scene").children[i].getAttribute("scale").z,
          },
          value: document.querySelector("#scene").children[i].getAttribute("value"),
          font: document.querySelector("#scene").children[i].getAttribute("font")
        });
      }
    }
    console.log({ jsonExpo });
    const form = new FormData();
    form.append("json", JSON.stringify(jsonExpo));
    form.append("nomExpo",document.querySelector("#txtNomExpo").value);
    form.append("descriptionExpo",document.querySelector("#txtDescriptionExpo").value);
    const request = new Request("../scripts/insertExpo.php", {
      method: "POST",
      body: form,
    });

    fetch(request).then((response) => {
      console.log(response);
      jsonOeuvres = undefined;
    });
  };

  document.querySelector("#btninfosoeuvre").onclick = function(){
    
    majInfosOeuvre(clickedOeuvreId, document.querySelector("#txttitre").value, document.querySelector("#txtdescription").value);
  }

  document.querySelector("#btnremplacer").onclick = function(){
    remplacerNumerosParModels(listeEmplacements);
  }

    let raycasterOnOeuvre;

    GenererTableau();
    document.querySelector("#table").onmouseover = GetCoordonnees;
    document.querySelector("#table").onmousedown = GetCoordonnees;
    if(document.querySelector("#chkgomme") !== null){
        document.querySelector("#chkgomme").onclick = function(event) {
          if(event.target.checked){
              gomme = true;
              porte = false;
              emplacement = false;
              document.querySelector("#chkporte").checked = false;
              document.querySelector("#chkemplacement").checked = false;
          }
          else{
              gomme = false;
          } 
      };
    }
    if(document.querySelector("#chkemplacement") !== null){
    document.querySelector("#chkemplacement").onclick = function(event) {
        if(event.target.checked){
            emplacement = true;
            porte = false;
            gomme = false;
            document.querySelector("#chkporte").checked = false;
            document.querySelector("#chkgomme").checked = false;
        }
        else{
            emplacement = false;
        } 
    };
    }
    if(document.querySelector("#chkporte") !== null){
    document.querySelector("#chkporte").onclick = function(event) {
        if(event.target.checked){
            porte = true;
            gomme = false;
            emplacement = false;
            document.querySelector("#chkgomme").checked = false;
            document.querySelector("#chkemplacement").checked = false;
        }
        else{
            porte = false;
        } 
    };
    }
    if(document.querySelector("#btnvider") !== null){
    document.querySelector("#btnvider").onclick = function(){
        listeCoordonnees = [];
        listeEmplacements = [];
        listePortes = [];
        cellulesEmplacements = [];
        GenererTableau();
    };
    }
    if(document.querySelector("#btngenerer") !== null){
    document.querySelector("#btngenerer").onclick = function(){
        document.querySelector("#upload").value = "";
        GenererExpo();
    }
  }
    
    document.querySelector("#camera").addEventListener("raycaster-intersected",function(e){
        
        //console.log('Player has collided with ', e.detail.body.el);
        //console.log(e.detail.target.el); // Original entity (camera).
        
        //console.log(e.detail.contact); // Stats about the collision (CANNON.ContactEquation).
        //console.log(e.detail.contact.ni); // Normal (direction) of the collision (CANNON.Vec3).
    });
    
    
    document.querySelector("#scene").addEventListener("loaded",function(e){
        console.log("SCENE LOADED")
    });
    
    document.querySelector("#scene").addEventListener("click",function(e){
        if(e.target.tagName === "A-TEXT")
        {
            console.log("ouhoooo")
            clickedTextValue = e.target.getAttribute("value");
            oeuvre=e;
            document.querySelector("#posx").value = e.target.getAttribute("position").x;
            document.querySelector("#posy").value = e.target.getAttribute("position").y;
            document.querySelector("#posz").value = e.target.getAttribute("position").z;
            document.querySelector("#rotx").value = e.target.getAttribute("rotation").x;
            document.querySelector("#roty").value = e.target.getAttribute("rotation").y;
            document.querySelector("#rotz").value = e.target.getAttribute("rotation").z;
            document.querySelector("#scal").value = e.target.getAttribute("scale").x;
        }

        if (e.target.id.includes("oeuvre")) {
          oeuvre = e;
          clickedOeuvreId = e.target.id;
          //playSound(e.target.id);
          document.querySelector("#posx").value = e.target.object3D.position.x;
          document.querySelector("#posy").value = e.target.object3D.position.y;
          document.querySelector("#posz").value = e.target.object3D.position.z;
          document.querySelector("#rotx").value = e.target.object3D.rotation.x;
          document.querySelector("#roty").value = e.target.object3D.rotation.y;
          document.querySelector("#rotz").value = e.target.object3D.rotation.z;
          document.querySelector("#scal").value = e.target.object3D.scale.x;
          console.log(e);
        }

    });




    document
      .querySelector("#cursor")
      .addEventListener("raycaster-intersection", function (e) {
        /* console.log(e.detail.els[0])
        if (e.detail.els[0].id === "b1") {
          document.querySelector("#e1").setAttribute("visible", true);
          raycasterOnOeuvre = true;
          let audio = new Audio('.mp3');
          audio.play();
        }
        if (raycasterOnOeuvre && e.detail.els[0].id === "e1"){
          document.querySelector("#e1").setAttribute("visible", true);
          raycasterOnOeuvre = false;
        } */
      });
  
    document
      .querySelector("#camera")
      .addEventListener("raycaster-intersection-cleared", function (e) {
        /* console.log(e);
        document.querySelector("#e1").setAttribute("visible", false); */
      });
  
    document.querySelector("#upload").onchange = function () {
      listeCoordonnees = [];
      listeEmplacements = [];
      listePortes = [];
      cellulesEmplacements = [];
      let reader = new FileReader();
      let file = document.querySelector("#upload").files[0];
      if (file.name.split(".").pop() === "svg") {
        document.querySelector("#imgsvg").src = URL.createObjectURL(file);
        reader.readAsText(file, "UTF-8");
        reader.onload = function (event) {
          if (window.DOMParser) {
            let walls = [];
            let cylindres = [];
            let listeEmplacements = [];
            let content = event.target.result;
  
            let parser = new DOMParser();
            let xmlDoc = parser.parseFromString(content, "text/xml");
            let gTag = xmlDoc.getElementsByTagName("g");
  
            listeCoordonnees = [];
            listeEmplacements = [];
            listePortes = [];
            cellulesEmplacements = [];
            GenererTableau();
            
            //let regex = /[a-zA-Z]/g;
            let scene = document.querySelector("#scene");
            while (scene.childNodes.length > 16) {
              scene.removeChild(scene.childNodes[scene.childNodes.length - 1]);
            }
            for (let k = 0; k < gTag.length; k++) {
              let paths = gTag[k].getElementsByTagName("path");
              for (let i = 0; i < paths.length; i++) {
                let path = paths[i].attributes["d"].value.split(" ");
  
                //modifie coords : notation scientifique -> float, coordonées relatives -> absolute, lettres -> nombres
                let coords = NotationScientiqueToFloat(path);
                coords = Snap.path.toAbsolute(coords);
                coords = TransformeCoordonnees(coords);
                //
  
                for (let j = 0; j < coords.length - 1; j++) {
                  let ancienNormeX;
                  let ancienNormeZ;
  
                  //if(!regex.test(path[j]) && !regex.test(path[j+1])){
                  let startX = coords[j].x;
                  let startZ = coords[j].z;
                  let endX = coords[j + 1].x;
                  let endZ = coords[j + 1].z;
  
                  let vecteur = {
                    x: endX - startX,
                    z: endZ - startZ,
                  };
                  let vecteurHorizontal = {
                    x: endX - startX,
                    z: 0,
                  };
                  let produitScalaire =
                    vecteur.x * vecteurHorizontal.x +
                    vecteur.z * vecteurHorizontal.z;
  
                  let normeV = Math.sqrt(
                    Math.pow(vecteur.x, 2) + Math.pow(vecteur.z, 2)
                  );
  
                  let rotation;
                  let angle;
                  let cos;
                  let wall = document.createElement("a-box");
                  if (vecteur.x === 0) {
                    wall.setAttribute("rotation", {
                      x: 0,
                      y: 90,
                      z: 0,
                    });
                  } else {
                    if (vecteur.z === 0) {
                      wall.setAttribute("rotation", {
                        x: 0,
                        y: 0,
                        z: 0,
                      });
                    } else {
                      let normeVH = Math.sqrt(
                        Math.pow(vecteurHorizontal.x, 2) +
                          Math.pow(vecteurHorizontal.z, 2)
                      );
  
                      cos = produitScalaire / (normeV * normeVH);
  
                      angle = Math.acos(cos) * (180 / Math.PI);
                      wall.setAttribute("rotation", {
                        x: 0,
                        y:
                          (vecteur.x > 0 && vecteur.z > 0) ||
                          (vecteur.x < 0 && vecteur.z < 0)
                            ? -angle
                            : angle,
                        z: 0,
                      });
                    }
                  }
                  console.log({ normeV });
                  wall.setAttribute("width", normeV);
                  wall.setAttribute("depth", 0.5);
                  wall.setAttribute("shadow", "");
  
                  let posY = 1.5;
  
                  // k = 0 -> mur
                  // k = 1 -> porte
                  // k = 2 -> emplacement oeuvre
                  switch (k) {
                    case 0:
                      wall.setAttribute("height", "3");
                      wall.setAttribute("static-body", "");
                      wall.setAttribute("color", "#443733");
                      break;
                    case 1:
                      wall.setAttribute("height", "0.5");
                      wall.setAttribute("color", "#221510");
                      posY = 2.75;
                      break;
                    default:
                      wall.setAttribute("height", "3");
                      wall.setAttribute("static-body", "");
                      wall.setAttribute("color", "#443733");
                  }
  
                  let posX = parseFloat(startX) + (endX - startX) / 2;
                  let posZ = parseFloat(startZ) + (endZ - startZ) / 2;
  
                  wall.setAttribute("position", {
                    x: posX,
                    y: posY,
                    z: posZ,
                  });
                  walls.push(wall);
  
                  //if (angle > 25 && angle < 65) {
                  //1 cylindre au début du premier mur, 1 cylindre à chaque fin de mur
  
                  if (j === 0) {
                    let cylindre = document.createElement("a-cylinder");
                    cylindre.setAttribute("height", 3.005);
                    cylindre.setAttribute("radius", 0.41);
                    cylindre.setAttribute("color", "#221510");
                    cylindre.setAttribute("shadow", "");
                    cylindre.setAttribute("geometry", "segmentsRadial: 6");
                    cylindre.setAttribute("static-body", "");
                    cylindre.setAttribute("position", {
                      x: startX,
                      y: 1.5,
                      z: startZ,
                    });
  
                    cylindres.push(cylindre);
                  }
  
                  let cylindre = document.createElement("a-cylinder");
                  cylindre.setAttribute("height", 3.005);
                  cylindre.setAttribute("radius", 0.41);
                  cylindre.setAttribute("color", "#221510");
                  cylindre.setAttribute("shadow", "");
                  cylindre.setAttribute("geometry", "segmentsRadial: 6");
                  cylindre.setAttribute("static-body", "");
                  cylindre.setAttribute("position", {
                    x: endX,
                    y: 1.5,
                    z: endZ,
                  });
  
                  cylindres.push(cylindre);
                  //}
                }
              }
            }
            if (gTag[2] !== undefined) {
              let emps = gTag[2].getElementsByTagName("ellipse");
              for (let l = 0; l < emps.length; l++) {
                listeEmplacements.push({
                  x: emps[l].attributes["cx"].value,
                  y: 0,
                  z: emps[l].attributes["cy"].value,
                });
              }
            }
  
            scene = document.querySelector("#scene");
            for (let m = 0; m < walls.length; m++) {
              walls[m].setAttribute("id", "mur" + m);
              scene.appendChild(walls[m]);
            }
            for (let m = 0; m < cylindres.length; m++) {
              cylindres[m].setAttribute("id", "cylindre" + m);
              scene.appendChild(cylindres[m]);
            }

            for (let m = 0; m < listeEmplacements.length; m++) {
                oeuvre = document.createElement("a-text");
                console.log(oeuvre);
                let colors = [
                  "red",
                  "green",
                  "blue",
                  "yellow",
                  "hotpink",
                  "orange",
                  "purple",
                ];
                oeuvre.setAttribute(
                  "color",
                  colors[Math.ceil(Math.random() * colors.length - 1)]
                );
                oeuvre.setAttribute("look-at", "[camera]");
                oeuvre.setAttribute("position", {
                    x: listeEmplacements[m].x,
                    y: 2.5,
                    z: listeEmplacements[m].z
                });
                oeuvre.setAttribute("font", "mozillavr");
                oeuvre.setAttribute("scale", {
                    x: 10,
                    y: 10,
                    z: 10
                });
                oeuvre.setAttribute("value", m + 1);
                /* oeuvre = document.createElement("a-gltf-model");
                oeuvre.setAttribute("src", "../assets/venus_de_milo.glb");
                oeuvre.setAttribute("id", "oeuvre" + listeEmplacements.indexOf(listeEmplacements[m]));
                oeuvre.setAttribute("position", {
                    x: listeEmplacements[m].x,
                    y: listeEmplacements[m].y,
                    z: listeEmplacements[m].z
                });
                oeuvre.setAttribute("static-body", "");
                oeuvre.setAttribute("scale", {
                    x: "0.01",
                    y: "0.01",
                    z: "0.01"
                }); */
                scene.appendChild(oeuvre);
            }
          }
        };
        reader.onerror = function (event) {
          alert("Erreur lors de la lecture du fichier");
        };
      } else {
        alert("Le fichier envoyé doit être un fichier SVG");
      }
    };
  };