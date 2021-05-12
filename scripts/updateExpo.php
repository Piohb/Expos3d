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
        
        $sql = "UPDATE exposition SET nom = '" . $_POST['nomExpo'] . "', codeExposition = '" . $_POST['json'] . "', description = '" . $_POST['descriptionExpo'] . "', idCreateur = " . $_SESSION['idUser'] . " WHERE idExposition = " . $_POST['id'];
        
        if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
}

?>