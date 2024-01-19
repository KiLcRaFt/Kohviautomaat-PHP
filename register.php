<?php
require_once("conf.php");
//$yhendus = mysqli_connect('localhost', 'martinnommiste', '123456', 'martinnommiste');
$yhendus = mysqli_connect($servernimi, $kasutaja, $parool, $andmebaas);

if (!empty($_POST['login']) && !empty($_POST['pass'])) {

    $login = htmlspecialchars(trim($_POST['login']));
    $pass = htmlspecialchars(trim($_POST['pass']));


    $cool = 'superpaev';
    $kryp = crypt($pass, $cool);


    $kask2 = $yhendus->prepare("INSERT INTO kasutaja (kasutaja, parool) VALUES (?, ?)");
    $kask2->bind_param("ss", $login, $kryp);
    $kask2->execute();

    echo '<script>alert("Registration successful!"); window.location.href = "kasutajaleht.php";</script>';

    $kask2->close();
    $yhendus->close();
    exit();

}
?>


<h1>Registreerimine</h1>
<a id="aclose" class="modalReg__close" href="#">X</a>
<form action="" method="post">
    <label for="login">Kasutaja nimi:</label>
    <input type="text" name="login"><br>
    <label for="pass" style="padding-left: 28px;">Password:</label>
    <input type="password" name="pass"><br>
    <br><input type="submit" value="Register">
</form>