
<?php
	include_once 'connection.php';



	$baza = new Baza();


	function usernameCheck($login) {
		$baza = new Baza();
	    $stmt = $baza->prepare("SELECT login FROM uzytkownicy WHERE login = :login");
	    $stmt->execute(array(
	    	':login' => $_POST['login']
	    ));

	    if($stmt->rowCount() > 0){
	        return false;
	    }
	    	else {
	    	return true;
	    	}
	}



	if(empty($_POST['imie']) || empty($_POST['nazwisko']) || empty($_POST['login']) || empty($_POST['haslo']) || empty($_POST['haslo2'])) {
    }

        elseif ($_POST['haslo']!=$_POST['haslo2']){
	           echo "Błąd->hasła nie są takie same";
        }


	else{
		if(usernameCheck($_POST['login'])) {
		$sql = "INSERT INTO uzytkownicy(imie, nazwisko, login, haslo, id_typ) VALUES( :imie, :nazwisko, :login, :haslo, 3)";
		$zapytanie = $baza -> prepare($sql);
		$wynik = $zapytanie->execute(array(
			':imie' => $_POST['imie'],
			':nazwisko' => $_POST['nazwisko'],
			':login' => $_POST['login'],
			':haslo' => md5($_POST['haslo'])
		));

		if($wynik) {
			echo "Zostałeś poprawnie zarejestrowany";
		}

			else {
			echo "Błąd -> coś poszło nie tak. Przejdź do strony głównej aby spróbować jeszcze raz";
			}
	}

	else {
		echo "Mamy już takiego typa!";
	}
}

?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/rejestracja.css" />
<title>Fitness 4 you</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="Stylesheet" type="text/css" href="rejestracja.css" />
</head>
<body>
<button class="back" type="button" id="back" onclick="location.href='index.html'"><span>Powrót</span></button>
</body>
</html>
