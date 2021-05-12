let dicoOeuvresSons = [];
let audio;
let oldId;

window.onload = function(){
document.querySelector("#scene").addEventListener("loaded",function(e){
        console.log("SCENE LOADED")
    });
    document.querySelector("#scene").addEventListener("click",function(e){
        if (e.target.id.includes("oeuvre")) {
          oeuvre = e;
          clickedOeuvreId = e.target.id;
          playSound(e.target.id);
        }
    });
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '../scripts/getoeuvres.php');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let json = JSON.parse(xhr.responseText);
            
            json.forEach(oeuvre => {             
              dicoOeuvresSons["oeuvre" + oeuvre.idOeuvre] = oeuvre.son;
            });
          }
        else if(xhr.readyState == 4 && xhr.status != 200) {
            alert(" Il y a une erreur lors de la reception des images \n Code erreur: " + xhr.status + "\n veuillez réessayer ultérieurement"); }
        };
    xhr.send(null);
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