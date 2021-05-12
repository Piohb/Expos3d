<?php
session_start();
if(isset($_POST['txtPseudo']) && isset($_POST['txtMdp']))
{
    
        $servername = "localhost:3306";
        $username = "user";
        $password = "tBr78n_4";
        $dbname = "db_expos3d";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
        $mdp=hash("sha256",$_POST["txtMdp"]);
        $reqCompteExiste = "SELECT idUser,username FROM user WHERE username='".$_POST['txtPseudo']."' AND password='". $mdp ."'";
        $result = $conn->query($reqCompteExiste);
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $compte[] = $row;
              $_SESSION["idUser"] = $compte[0]["idUser"];
              $_SESSION["User"] = $_POST['txtPseudo'];
          }
          header("Location: ../index.php");
        }
        else
        {
            header("Location: ../formulaires/inscription.php");
        }
        
}

?>