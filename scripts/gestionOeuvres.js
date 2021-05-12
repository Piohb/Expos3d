  let listeModels = {};
  let clickedTextValue;
  let clickedOeuvreId; 
  let dicoOeuvresSons = [];
  let audio;
  let oldId;

  function chargerOeuvres(){
  let xhr = new XMLHttpRequest();

  xhr.open('GET', '../scripts/getoeuvres.php');
  xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
          let json = JSON.parse(xhr.responseText);
          console.log(json);
          json.forEach(oeuvre => {
            let div = document.createElement("div");
            let divEnfant = document.createElement("div");
            let title = document.createElement("h5");
            let paragraphe = document.createElement("p");
            let button = document.createElement("button");

            div.className = "card mb-3 oeuvre_card";


            divEnfant.className = "card-body";
            
            title.className = "card-title";
            title.innerText = oeuvre.nom;
            
            paragraphe.className = "card-text";
            paragraphe.innerText = oeuvre.description;

            button.className = "btn_add";
            button.innerHTML = `<img src="../assets/img/add_oeuvre.svg" alt="ajouter l'oeuvre">`;
            button.addEventListener("click", function(e){
              mettreModele(clickedTextValue, oeuvre.nom, oeuvre.description, oeuvre.idOeuvre, oeuvre.url)
            });
            paragraphe.appendChild(button);

            divEnfant.appendChild(title);
            divEnfant.appendChild(paragraphe);
            
            div.appendChild(divEnfant);
            document.querySelector("#divAcordeonOeuvres").appendChild(div);
            dicoOeuvresSons["oeuvre" + oeuvre.idOeuvre] = oeuvre.son;
          });
        }
      else if(xhr.readyState == 4 && xhr.status != 200) {
          alert(" Il y a une erreur lors de la reception des images \n Code erreur: " + xhr.status + "\n veuillez réessayer ultérieurement"); }
      };
  xhr.send(null);
}

function remplacerNumerosParModels(emplacements){
  let scene = document.querySelector("#scene");
  for(let i = 0; i < scene.children.length; i++){
    
    if(scene.children[i].tagName.toUpperCase() === "A-TEXT"){
      console.log(scene.children[i])
      scene.children[i].remove();
      i = i - 1;
    }
  }
  for(key in listeModels){
      let oeuvre = document.createElement("a-gltf-model");
      oeuvre.setAttribute("src", listeModels[key]);
      oeuvre.setAttribute("id", "oeuvre" + listeEmplacements.indexOf(emplacements[key - 1]));
      oeuvre.setAttribute("position", {
          x: emplacements[key - 1].x,
          y: emplacements[key - 1].y,
          z: emplacements[key - 1].z
      });
      oeuvre.setAttribute("static-body", "");
      oeuvre.setAttribute("scale", {
          x: "0.01",
          y: "0.01",
          z: "0.01"
      });
      scene.appendChild(oeuvre);
  }
}

function ajouterOeuvresToExpo(noEmplacement, url){console.log({listeModels})
  if(listeModels !== undefined){
    listeModels[noEmplacement] = url;
    
  }
}

let events = {};
function mettreModele(clickedTextValue, titre, desc, id, url){
  if(clickedTextValue){
    document.querySelector("#scene").childNodes.forEach((node) => {
      if(node.tagName === "A-TEXT" && node.getAttribute("value") === clickedTextValue){
        document.querySelector("#scene").removeChild(node);
        let oeuvre = document.createElement("a-gltf-model");
        oeuvre.setAttribute("src", url);
        oeuvre.setAttribute("id", "oeuvre" + (id));
        oeuvre.setAttribute("position", {
            x: node.getAttribute("position").x,
            y: 0,
            z: node.getAttribute("position").z
        });
        oeuvre.setAttribute("static-body", "");
        oeuvre.setAttribute("scale", {
            x: "0.01",
            y: "0.01",
            z: "0.01"
        }); 
        let description = document.createElement("a-text");
        description.setAttribute("font", "mozillavr");
        description.setAttribute("scale", {
          x : 1,
          y : 1,
          z : 1
        });
        description.setAttribute("position", {
          x : node.getAttribute("position").x + 1,
          y : 2,
          z : node.getAttribute("position").z + 1
        });

        description.setAttribute("color", "brown");
        description.setAttribute("id", "texte" + (id));
        description.setAttribute("anchor", "center");
        description.setAttribute("align", "center");
        description.setAttribute("baseline", "bottom");
        description.setAttribute("geometry", {
          primitive : "plane"
        });

        description.setAttribute("value", titre + " : " + desc);
        description.setAttribute("look-at", "[camera]");
        document.querySelector("#scene").appendChild(description);
        document.querySelector("#scene").appendChild(oeuvre);
        
        if(events["#" + "oeuvre" + (id)] === undefined){
          events["#" + "oeuvre" + (id)] = true;
          document.querySelector("#spinner").style.display = "block";
          document.querySelector("#" + "oeuvre" + (id)).addEventListener("model-loaded", () => {document.querySelector("#spinner").style.display = "none";});
        }
      }
    });
  }
}

function majInfosOeuvre(id, titre, description){
  console.log(id);
  if(id !== undefined){
    $.ajax({
      url: "../scripts/majInfosOeuvre.php",
      type: 'POST',
      cache: false,
      data: {
          id : id.substr(6),
          titre: titre,
          description : description
      },
      error: function(jqXHR, textStatus, errorThrown) {
          console.log(jqXHR, textStatus, errorThrown);
      },
      success: function(data) {
          console.log(data)  
          document.querySelector("#texte" + id.substr(6)).setAttribute("value", titre + " : " + description);
      }
  });
  }
}

function playSound(id){
  if(oldId === undefined){
    oldId = id;
  }
  if(id === oldId){
    if(audio === undefined){
      audio = new Audio(dicoOeuvresSons[id]);
    }
    if(audio.paused){
      audio.play();
    }
    else{
      audio.pause();
    }
  }
  else{
    if(audio !==undefined){
      audio.pause();
    }
    audio = new Audio(dicoOeuvresSons[id]);
    audio.play();
  }
  oldId = id;
}