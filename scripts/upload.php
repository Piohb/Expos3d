<?php
    if(isset($_POST['file']))
    { 
        $dossier = '../models/';
        $fichier = $_POST['file'];
            $servername = "localhost:3306";
            $username = "user";
            $password = "tBr78n_4";
            $dbname = "db_expos3d";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }
              
              $sql = "INSERT INTO oeuvre (nom, description, url, idExpo)
              VALUES ('$fichier', 'desc', '" . $dossier . $fichier . "', 1)";
              
              if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }

            $conn->close();

    }

?>

