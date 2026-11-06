<?php

/* Controllo l'ambiente in cui sta girando il sito */

$environment = ($_SERVER['HTTP_HOST'] === 'localhost') ? 'sviluppo' : 'produzione';

//echo 'ambiente: ' . $environment . '<br><br>'; // solo per test

require('config.php'); // credenziali

/* Controllo se il sito sta girando in modalità test */

$test = (
	$environment === 'sviluppo' ||
	str_starts_with($_SERVER['SCRIPT_NAME'], '/test/')
);

//echo 'test: ' . $test . '<br><br>'; // solo per test
