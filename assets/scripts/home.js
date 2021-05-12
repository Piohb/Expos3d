import { OrbitControls } from "https://threejs.org/examples/jsm/controls/OrbitControls.js";

var scene, camera, renderer;

scene = new THREE.Scene();
//scene.background = new THREE.Color(0x5f5f0f);

camera = new THREE.PerspectiveCamera(50, 350/350);
camera.position.x = 0;
camera.position.y = 100;
camera.position.z = 1000;
//camera.position.set(0, 100, 1000);

renderer = new THREE.WebGLRenderer({ alpha: true });
renderer.setClearColor( 0x000000, 0 );
renderer.setSize(350, 350);
document.body.appendChild(renderer.domElement);

var controls = new OrbitControls(camera, renderer.domElement);
controls.update();

var abint = new THREE.AmbientLight(0xffffff);
scene.add(abint);

var loader = new THREE.GLTFLoader();
var modelArray = [];
var currentModelIndex = 0;
loader.load('models/home/greek_inscription_from_cirenaica/scene.gltf', (result) => { modelArray[0] = result; displayModel(currentModelIndex)}); // load the first model and display it
loader.load('models/home/rana_chilena/scene.gltf', (result) => { modelArray[1] = result});
loader.load('models/home/mv_spartan/scene.gltf', (result) => { modelArray[2] = result});
loader.load('models/home/perseverance/scene.gltf', (result) => { modelArray[3] = result});
loader.load('models/home/animal_cell_-_downloadable/scene.gltf', (result) => { modelArray[4] = result});
loader.load('models/home/matilda/scene.gltf', (result) => { modelArray[5] = result});
//loader.load('models/home/corset/scene.gltf', (result) => { modelArray[6] = result});
//loader.load('models/home/perseverance_-_nasa_mars_landing_2021/scene.gltf', (result) => { modelArray[7] = result});

function displayModel(index){
    console.log(modelArray[index]);
    modelArray.forEach( model => { scene.remove(model.scene); } ); // remove all models from the scene

    if (index === 0){
        modelArray[index].scene.scale.set(3,3,3);
    } else if (index === 2){
        modelArray[index].scene.scale.set(25,25,25);
    } else if (index === 1 || index === 4) {
        modelArray[index].scene.scale.set(50,50,50);
    } else if (index === 3){
        modelArray[index].scene.scale.set(100,100,100);
    }

    scene.add(modelArray[index].scene); // add the chosen model to the scene
}

/*loader.load('models/home/greek_inscription_from_cirenaica/scene.gltf', function (gltf) {
    gltf.scene.scale.set(3,3,3);
    scene.add(gltf.scene);
    //gltf.scene.position.y = -100;
});*/

function animate() {
    requestAnimationFrame(animate);
    renderer.render(scene, camera);
}

animate();

$(document).ready(function () {
   $('.frameCard').on('click', function () {
       let val = $(this).data("model");
       $('.frameCard.active').removeClass('active');
       $(this).addClass('active');
       displayModel(val);
   });
});
