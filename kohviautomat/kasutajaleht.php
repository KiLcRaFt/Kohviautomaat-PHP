<?php
require_once ('conf2.php');
session_start();
function isAdmin(){
    return isset($_SESSION['onAdmin']) && $_SESSION['onAdmin']==1;
}

if (isset($_REQUEST["miinus"])) {
    global $yhendus;

    $kask2 = $yhendus->prepare("SELECT topsejuua, topsepakis FROM kohviautomaat WHERE id=?");
    $kask2->bind_param("i", $_REQUEST["miinus"]);
    $kask2->execute();
    $kask2->bind_result($topsejuua, $topsepakis);
    $kask2->fetch();
    $kask2->close();
    if ($topsejuua <= 0 && $topsepakis <= 0) {
        $answer = "Seda positsiooni on otsas";
    }
    else if ($topsejuua == 0) {
        $kask3 = $yhendus->prepare("UPDATE kohviautomaat SET topsepakis=topsepakis-1 WHERE id=?");
        $kask3->bind_param("i", $_REQUEST["miinus"]);
        $kask3->execute();
        $kask3->close();

        $kask4 = $yhendus->prepare("UPDATE kohviautomaat SET topsejuua=topsejuua+50 WHERE id=?");
        $kask4->bind_param("i", $_REQUEST["miinus"]);
        $kask4->execute();
        $kask4->close();
    }


    else {
        $kask = $yhendus->prepare("UPDATE kohviautomaat SET topsejuua=topsejuua-1 WHERE id=?");
        $kask->bind_param("i", $_REQUEST["miinus"]);
        $kask->execute();
        $kask->close();
    }
}

?>
<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tansud tätedega</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/modalLogin.css">
    <link rel="stylesheet" type="text/css" href="style/modalReg.css">
    <link rel="stylesheet" type="text/css" href="style/modalOtsas.css">
</head>

<body>
<?php
if(!isAdmin()) {
    ?>
    <div id="modalOtsas">
        <div class="modalOtsas__window">
            <?php
            require('otsas.php');
            ?>
        </div>
    </div>
    <div id="modal">
        <div class="modal__window">
            <?php
            require('login.php');
            ?>
        </div>
    </div>
    <div id="modalReg">
        <div class="modalReg__window">
            <?php
            require('register.php');
            ?>
        </div>
    </div>
    <?php
}
?>
<h1>Kohviautomaat</h1>
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
        <div class="open">
            <a href="#modal">Logi sisse</a>
            <br>
            <a href="#modalReg">Registreerimine</a>
        </div>
        <?php
    }
    ?>
</header>
<nav>
    <ul class="navigation">
        <li class="navi"><h2><a href=""> Kasutaja Leht </a></h2></li>
        <?php
        if(isAdmin()) {
            ?>
            <li class="navi" ><h2 ><a href = "adminleht.php" > Administreerimis Leht </a ></h2 ></li >
            <?php
        }
        ?>
    </ul>
</nav>
<?php
if(!isset($_SESSION["kasutaja"])) {
    echo "<h1 id='eikasutaja'><p>Muudetud põhilehe kirjeldus</p></h1>";
}
?>
<?php
if(isset($_SESSION["kasutaja"])) {
    ?>
    <table>
        <tr>
            <th>Nimetus</th>
            <th>Topsepakk</th>
            <th>Jook</th>
            <th></th>
        </tr>
        <?php

            global $yhendus;
            $kask=$yhendus->prepare("Select id, joohinimi, topsepakis, topsejuua from kohviautomaat");
            $kask->bind_result($id, $joohinimi, $topsepakis, $topsejuua);
            $kask->execute();
            while($kask->fetch()) {

                echo "<tr>";
                /*$tantsupaar=htmlspecialchars($tantsupaar);*/
                echo "<td>" . $joohinimi . "</td>";
                echo "<td>" . $topsepakis . "</td>";
                echo "<td>" . $topsejuua . "</td>";
                if($topsejuua <= 0 && $topsepakis <= 0){
                    echo "<td><a href='#modalOtsas'>Otsas</a></td>";
                }
                else {
                    echo "<td><a href='?miinus=$id'>Joo uks kohv</a></td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
    <?php
}
?>
</body>
</html>

