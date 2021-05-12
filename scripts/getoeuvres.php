<?php
    $servername = "localhost:3306";
    $username = "user";
    $password = "tBr78n_4";
    $dbname = "db_expos3d";
    $oeuvres = [];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      
      $sql = "SELECT idOeuvre, nom, description, url, son FROM oeuvre";
      
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $oeuvres[] = $row;
        }
      }

    $conn->close();
    exit(json_encode($oeuvres));
?>