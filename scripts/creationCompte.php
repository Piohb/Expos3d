<?php
if(isset($_POST['txtEmail']) && isset($_POST['txtUsername']) && isset($_POST['txtPassword']) && isset($_POST['txtVerifPassword']))
{
    if($_POST['txtPassword'] == $_POST['txtVerifPassword'])
    {
        $servername = "localhost:3306";
        $username = "user";
        $password = "tBr78n_4";
        $dbname = "db_expos3d";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

        $reqPseudoExiste = "SELECT username FROM user WHERE username='".$_POST['txtUsername']."'";
        $resultPseudoExiste = $conn->query($reqPseudoExiste);
        if ($resultPseudoExiste->num_rows == null) {
            $reqEmailExiste = "SELECT email FROM user WHERE username='".$_POST[txtEmail]."'";
            $resultEmailExiste = $conn->query($reqEmailExiste);
            if ($resultEmailExiste->num_rows == null) {
                $mdp=hash("sha256",$_POST["txtPassword"]);
                $reqInsertUser = "INSERT INTO user (email,username,password) VALUES ('" . $_POST['txtEmail']."','".$_POST['txtUsername']."','". $mdp ."')";
                if($conn->query($reqInsertUser) === TRUE) {
                    echo "New record created successfully";
                    } 
                else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();
                header("location: ../formulaires/inscription.php");
            }
            else
            {
                //echo("L'email renseignée est déja utilisé");
                $conn->close();
                header("location: ../formulaires/inscription.php");
            }
        }
        else
        {
            //echo("Le pseudo renseignée est déja utilisé");
            $conn->close();
            header("location: ../formulaires/inscription.php");
        }
    }
    else
    {
        //echo("Le mot de passe renseignée n'est pas identique au premier !");
        header("location: ../formulaires/inscription.php");
    }
}

?>