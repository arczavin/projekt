<?php
    include_once 'connection.php';

    $db = new Baza();
   
    $sql = 'SELECT * FROM uzytkownicy WHERE login = :login and haslo = :haslo limit 1';
    $query = $db->prepare($sql);

    $query -> execute(array(
        ':login' => $_POST['login'],
        ':haslo' => md5($_POST['haslo'])
    ));

    $wynik = $query->fetch();

    if($wynik) {
        $date = new DateTime('NOW');
        $date_string  = $date->format('Y-m-d H:i:s');
        $hash = md5($date_string . $wynik['id_uzytkownika']);//łącze 2 stringi dzisiejszą date i id uzytkownika i zapisuję przez md5
        $ip = $_SERVER['REMOTE_ADDR'];
        $browser = $_SERVER[HTTP_USER_AGENT];


        $sql = 'INSERT INTO sesja VALUES(NULL, :user_id, now(), :hash, :adres_ip, :przegladarka)';
        $query = $db->prepare($sql);
        $result = $query -> execute(array(
            ':user_id' => $wynik['id_uzytkownika'],
            ':hash' => $hash,
            ':adres_ip' => $ip,
            ':przegladarka' => $browser
        ));

        if ($result) {
            setcookie("tajne_dane", $hash, time()+3600);
            if($wynik['id_typ'] == 3) {
                header("Location: panel.php");                
            } else {
                header("Location: panel_ins.php");
            }
        } else {
            echo('db error');
        }

    } else {
        echo("nie pykło");
    }

?>