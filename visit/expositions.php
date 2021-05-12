<?php require("../views/head.html"); ?>
<body class="expoList">
<?php require ("../views/menu.php"); ?>
<script>
    fetch("../assets/scripts/colors.json")
        .then(res => res.json())
        .then(res => data = res)
        .then(function () {

            console.log(data);
            $('.expo').each(function () {
                let color = data[Math.floor(Math.random() * data.length)].color;
                $(this).css("background-color", color);
                console.log(color);
            });
        });
</script>

<div class="container">

    <header role="banner">
        <h1 class="title_create">liste des expositions</h1>

        <section class="row my-4" id="searchbar">
            <input class="col-8 col-sm-6 offset-2 offset-sm-3" type="text" placeholder="Un nom d'exposition...">
        </section>
    </header>

    <main class="row" role="main">
    <?php
        $servername = "localhost:3306";
        $username = "user";
        $password = "tBr78n_4";
        $dbname = "db_expos3d";
        $expositions = [];

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT idExposition, nom, description, username, idUser FROM exposition INNER JOIN user on user.idUser = exposition.idCreateur";
        
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $expositions[] = $row;
                $text = "<div class='expoCard col-12 col-sm-6 col-md-4 col-lg-3 mb-3'>";
                if($_SESSION["idUser"] == $row['idUser']){
                    $text = $text . "<a class='pb-2' style='display: inherit; text-align: center; color: black' href='http://89.234.180.61/plesk-site-preview/expos3d.fr/https/89.234.180.61/generation/modifier.php?id=" . $row["idExposition"] . "'>Modifier</a>";
                }
                else{
                    $text = $text . "<a class='pb-2' href='#' style='opacity: 0; color: black'>&nbsp;</a>";
                }
                $text = $text . "<a href='http://89.234.180.61/plesk-site-preview/expos3d.fr/https/89.234.180.61/visit/exposition.php?id=".$row['idExposition']."' class='expo'>
                <div class='expoTitle'>
                <h6>".$row['nom']."</h6>
                <p class='mt-3'>".$row['description']."</p>
                </div>
                <div class='expoLink'>
                <img src='../assets/img/copy.svg' alt='copy paste link' data-link='link' onclick='copyToClipboard(this)'>
                </div>
                <div class='expoUser'>
                <img src='../assets/img/user.svg' alt='user picto'>
                <p>".$row['username']."</p>
                </div>
                </a>";
                
                $text = $text . "</div>";
                echo($text);
            }
        }

        $conn->close();
    ?>
    </main>
</div>

<script>
    function copyToClipboard(el){
        let link = el.dataset.link;
        navigator.clipboard.writeText(link).then(function() {
            /* clipboard successfully set */
            //console.log(link);
        });
    }

    $(document).ready(function () {
        $('#searchbar input').on('input', function () {

            let value = $(this).val().toLowerCase();

            $('.expo h6').filter(function () {
                let item = $(this).closest('.expoCard');
                if ($(this).text().toLowerCase().indexOf(value) > -1){
                    item.css('display', 'block');
                } else {
                    item.css('display', 'none');
                }
            });
        });
    });
</script>
</body>
</html>