<?php

    $servername = "localhost:3306";
    $username = "user";
    $password = "tBr78n_4";
    $dbname = "db_expos3d";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        echo $_POST['titre'];
        $sql = "UPDATE oeuvre SET nom = '$_POST[titre]', description = '$_POST[description]'
        WHERE idOeuvre = $_POST[id]";
        
        if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

    $conn->close();

?>