<?php
session_start();
    if(isset($_POST['json']))
    { 
        $servername = "localhost:3306";
        $username = "user";
        $password = "tBr78n_4";
        $dbname = "db_expos3d";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "INSERT INTO exposition (nom, codeExposition, description, idCreateur) VALUES ('". $_POST['nomExpo'] ."', '" . $_POST['json'] . "','". $_POST['descriptionExpo'] ."','". $_SESSION['idUser'] ."')";
            
            if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
    }

?>