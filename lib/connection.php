<?php


class Baza extends PDO {
	public function __construct() {
		parent::__construct('mysql:host=127.0.0.1;dbname=inz', 'root', '');
	}
}

?>