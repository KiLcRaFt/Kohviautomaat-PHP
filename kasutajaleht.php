<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__, 1));}?>
<?php
require_once ('conf.php');
session_start();
function isAdmin(){
    return isset($_SESSION['onAdmin']) && $_SESSION['onAdmin']==1;
}

//Kui me klikime "Lahkeme uks pakk"
if(isset($_REQUEST['Loopakki'])){
    global $yhendus;

    $kask2 = $yhendus->prepare("SELECT topsepakis FROM kohviautomaat WHERE id=?");
    $kask2->bind_param("i", $_REQUEST["Loopakki"]);
    $kask2->execute();
    $kask2->bind_result($topsepakis);
    $kask2->fetch();
    $kask2->close();

    //kui pakkid on otsas
    if($topsepakis <= 0){
        $pakkans = "Pakkid on otsas";
    }

    //kui on vaba pakkid
    if($topsepakis >= 1) {

        $kask3 = $yhendus->prepare("UPDATE kohviautomaat SET topsepakis=topsepakis-1 WHERE id=?");
        $kask3->bind_param("i", $_REQUEST["Loopakki"]);
        $kask3->execute();
        $kask3->close();

        $kask4 = $yhendus->prepare("UPDATE kohviautomaat SET topsejuua=topsejuua+50 WHERE id=?");
        $kask4->bind_param("i", $_REQUEST["Loopakki"]);
        $kask4->execute();
        $kask4->close();
        header("Location: $_SERVER[PHP_SELF]");
    }
}

//kui me klikime "Joo uks jook"
if (isset($_REQUEST["miinus"])) {
    global $yhendus;

    $kask2 = $yhendus->prepare("SELECT topsejuua, topsepakis FROM kohviautomaat WHERE id=?");
    $kask2->bind_param("i", $_REQUEST["miinus"]);
    $kask2->execute();
    $kask2->bind_result($topsejuua, $topsepakis);
    $kask2->fetch();
    $kask2->close();
    // kas on topsid?
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
        header("Location: $_SERVER[PHP_SELF]");
    }


    else {
        $kask = $yhendus->prepare("UPDATE kohviautomaat SET topsejuua=topsejuua-1 WHERE id=?");
        $kask->bind_param("i", $_REQUEST["miinus"]);
        $kask->execute();
        $kask->close();
        header("Location: $_SERVER[PHP_SELF]");
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
    <title>Kohviautomaat</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/modalLogin.css">
    <link rel="stylesheet" type="text/css" href="style/modalReg.css">
    <link rel="stylesheet" type="text/css" href="style/modalOtsas.css">
</head>

<body>
<?php
if(isset($_SESSION["kasutaja"]) or isset($_SESSION["!kasutaja"])) {
?>
    <div id="modalOtsas">
        <div class="modalOtsas__window">
            <?php
            require('otsas.php');
            ?>
        </div>
    </div>
<?php
}
//modal windows
if(!isAdmin()) {
    ?>
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
    <?php
    if(!isset($_SESSION["kasutaja"])) {
        echo '<ul class="navigation"><li class="navi"><h2><a href="">Avaleht</a></h2></li></ul>';
    }
    else{
        ?>
    <ul class="navigation">
            <li class="navi" ><h2 ><a href = "" > Kasutaja Leht </a ></h2 ></li >
        <?php
        if(isAdmin()) {
            ?>
            <li class="navi" ><h2 ><a href = "adminleht.php" > Administreerimis Leht </a ></h2 ></li >
            <?php
        }
        ?>
    </ul>
    <?php
    }
    ?>
</nav>
<?php
// kui me oleme avalehtis
if(!isset($_SESSION["kasutaja"])) {
    echo "<table id='section1'>";
    echo "<td colspan='2'><form id='eikasutaja'>";
    echo "<h1 class='eikasutaja'><p>Kohviautomaat</p></h1>";
    echo "<p class='eikasutaja' style='font-size: 26px;'>Tere-tere! Kas soovite tassi kohvi, teed või midagi keerulisemat? Aga siinsamas läheduses on ainult see müügiautomaat? Siis registreeru! Muidu pole sul valikut))))))</p>";
    echo "</form></td>";
    echo "<td colspan='1'><img src='kohv.png' alt='Ilus kohviautomaat' id='kohv'></td>";
    echo "</table>";
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
                    if(isset($_SESSION["kasutaja"]) or isset($_SESSION["!kasutaja"])) {
                    echo "<td><a href='#modalOtsas'>Otsas</a></td>";
                    }
                }
                else {
                    echo "<td><a href='?miinus=$id'>Joo uks jook</a></td>";
                }
                if(isAdmin()) {
                    if($topsepakis <= 0) {
                        echo "<td><a href='#'>Pakkid on otsas</a></td>";
                    }
                    else{
                        echo "<td><a href='?Loopakki=$id'>Tee lahti uks pakk</a></td>";
                    }
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

