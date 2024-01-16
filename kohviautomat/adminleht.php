<?php
require_once ('conf.php');

session_start();

// punktide lisamine
if(isset($_REQUEST["pluss"])){
    global $yhendus;
    $kask=$yhendus->prepare("UPDATE kohviautomaat SET topsepakis =topsepakis+1 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["pluss"]);
    $kask->execute();
}

?>
<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kohviautomaat</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/modalLogin.css">
</head>
<body>
<h1 id="topheader">Kohviautomaat</h1>
<header>
    <?php
    if(isset($_SESSION['kasutaja'])){
        ?>
        <h1>Tere, <?="$_SESSION[kasutaja]"?></h1>
        <div>
            <a href="logout.php">Logi välja</a>
        </div>
        <?php
    } else {
        ?>
        <div>
            <a href="login.php">Logi sisse</a>
        </div>
        <?php
    }
    ?>
</header>
<nav>
    <ul class="navigation">
        <li class="navi"><h2><a href=""> Administreerimis Leht </a></h2></li>
        <li class="navi"><h2><a href="kasutajaleht.php"> Kasutaja Leht </a></h2></li>
    </ul>
</nav>
<table>
    <tr>
        <th>Nimetus</th>
        <th>Topsepakk</th>
        <th>Jook</th>
    </tr>
    <?php
    global $yhendus;
    $kask=$yhendus->prepare("Select id, joohinimi, topsepakis, topsejuua from kohviautomaat");
    $kask->bind_result($id, $joohinimi, $topsepakis, $topsejuua);
    $kask->execute();
    while($kask->fetch()){

        echo "<tr>";
        /*$tantsupaar=htmlspecialchars($tantsupaar);*/
        echo "<td>".$joohinimi."</td>";
        echo "<td>".$topsepakis."</td>";
        echo "<td>".$topsejuua."</td>";
        echo "<td><a href='?pluss=$id'>Lisa 1 topsepakk</a></td>";
        echo "</tr>";
    }
    ?>

</table>
</body>
</html>

