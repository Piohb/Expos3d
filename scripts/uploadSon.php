<?php
if(isset($_FILES['file']))
{ 
    $dossier = '../sounds/';
    $fichier = basename($_FILES['file']['name']);
    $complete = $dossier . $fichier; 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $dossier . $fichier))
    {
        $servername = "localhost:3306";
        $username = "user";
        $password = "tBr78n_4";
        $dbname = "db_expos3d";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          
          $sql = "UPDATE oeuvre SET son = '$complete'
          WHERE idOeuvre = $_POST[idOeuvre]";
          
          if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }

        $conn->close();
    }
    else
    {
        
    }
}



?>