## Sisukord
1. [Kohviautomaat](https://github.com/KiLcRaFt/Kohviautomaat-PHP/tree/main/README.md#kohviautomaat)
  2. [Kirjeldus](https://github.com/KiLcRaFt/Kohviautomaat-PHP?tab=readme-ov-file#colorgraykirjeldus)
  3. [Valmistatud koos](https://github.com/KiLcRaFt/Kohviautomaat-PHP?tab=readme-ov-file#valmistatud-koos)
  4. [Veebisait](https://github.com/KiLcRaFt/Kohviautomaat-PHP?tab=readme-ov-file#colorgrayveebisait)
  5. [Koodinäidised](https://github.com/KiLcRaFt/Kohviautomaat-PHP?tab=readme-ov-file#koodi-n%C3%A4ididsed)

# Kohviautomaat


Automaat saab hakkama mitme joogiga (kohv, tee, kakao). Lehel näidatakse vaid neid jooke, millel on vähemasti üks tops juua. Joomise tulemusena vähendatakse vastava joogi olemasolevate topside loendurit. Halduslehel saab joodavate topside arvu kogust suurendada täitepaki jagu.

## ${\color{gray}Kirjeldus}$
 - ### Projekti saab:
   1. Registreerida ja sisse logida kasutajana ja administratorina.
   2. __Oosta joogid__
 - #### Administraatorile
   * **Pakendit lisamda**
   * **Jookide lisamine** ja <sub>muutmine</sub> 

## Valmistatud koos:
![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)

| Osa           | Õigused       
| ------------- |:-------------:
| Admin         | Pakettide lisamine ja lahtipakkimine
| Kasutaja      | Toote ostmine      
  


### Sõltuvused

* Veebibrauser (Google Chrome, Firefox)
* Wi-Fi
* Andmebaas



### ${\color{gray}Veebisait}$
  
* [Link Kohviautomaat veebilehele](https://martinnommiste22.thkit.ee/jsLeht/content/kohviautomat/kasutajaleht.php)

**Külalise leht**
<br>
<img src="https://github.com/KiLcRaFt/Kohviautomaat-PHP/blob/c8e53cb45399cf0fd056f0184887c2a2d7e5d464/pildid/Main.PNG" alt="pilt" style="width: 50%; height: auto;">


### ${\color{gray}Kasutaja leht}$
**Avaleht, kui kasutaja on sisse logitud**
<br>
<img src="https://github.com/KiLcRaFt/Kohviautomaat-PHP/blob/c8e53cb45399cf0fd056f0184887c2a2d7e5d464/pildid/KasutajaLeht.PNG" alt="kasutaja" style="width: 50%; height: auto;">


### ${\color{green}Admin leht}$
**Avaleht, kui admin on sissu logitud**
<br>
<img src="https://github.com/KiLcRaFt/Kohviautomaat-PHP/blob/c8e53cb45399cf0fd056f0184887c2a2d7e5d464/pildid/AdminLeht.PNG" alt="admin" style="width: 50%; height: auto;">





### Koodi näididsed 


Funktsioon mis tagastab -1 topsejuua väärtuse andmebaaside
```
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
```


## Autorid

ex. Martin Nõmmiste

## Versiooni ajalugu

* Vaata [commit change]() või Vaata [release history]()


## License

This project is licensed under the [Martin Nõmmiste] License - see the LICENSE.md file for details

## Harjutused

1. Vaheta background color
2. Muuta tervitussõnumi asukoht "logi välja" kõrval (sõnum nt "Tere admin")
3. Ümardatud nurgad ülemises menüüs
4. Muuta php failis esilehe kirjelduses
5. Lisa veel üks jook php failis
6. Nime "Kohviautomaat" jaoks tehke ümaraid border.

Kuidas logi sisse admini (login: admin | parool:admin)
