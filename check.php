<?php

include_once 'connection.php';

class Sesja {
	function __construct() {
		$this->db = new Baza();
		$this->check();
	}

	public function check() {
		$sql = 'SELECT uzytkownicy.id_typ, sesja.* FROM sesja INNER JOIN uzytkownicy ON uzytkownicy.id_uzytkownika = sesja.id_uzytkownika where hash = :hash';
		$query = $this->db->prepare($sql);
		$query->execute(array(
			':hash' => $_COOKIE['tajne_dane']
	
		));

		$result = $query -> fetch();

		if($result) {
			$this->object = $result;
		}else {
			header("Location: index.html");
		}
	}

	public function only_for_user() {
		if ($this->object['id_typ'] = 2) {
			header("Location: panel.php");
		}
	}

	public function only_for_superuser() {
		if ($this->object['id_typ'] == 3) {
			header("Location: panel_ins.php");
		}
	}
}

$check = new Sesja();

?>
