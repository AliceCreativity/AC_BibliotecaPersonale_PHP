<?php 

/* Controllo l'ambiente in cui sta girando il sito */

$environment = ($_SERVER['HTTP_HOST'] === 'localhost') ? 'sviluppo' : 'produzione';

//echo 'ambiente: ' . $environment . '<br><br>'; // solo per test

require('config.php'); // credenziali

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} 
catch (PDOException $e) {

    die("Errore di connessione al database: " . $e->getMessage());

}


/* Controllo se il sito sta girando in modalità test */

$test = (
	$environment === 'sviluppo' ||
	str_starts_with($_SERVER['SCRIPT_NAME'], '/test/')
);

//echo 'test: ' . $test . '<br><br>'; // solo per test


/* Paginazione */

$perPagina = 10; // Numero di libri per pagina
$pagina = max(1, (int)($_GET["pagina"] ?? 1));

$totaleLibri = (int)$pdo->query("SELECT COUNT(*) FROM libri")->fetchColumn();
$totalePagine = max(1, (int)ceil($totaleLibri / $perPagina));

$pagina = min($pagina, $totalePagine);
$offset = ($pagina - 1) * $perPagina;


/* Recupero i libri dal database */

$sqlLibri = "SELECT id, numero, titolo, descrizione, autore, editore, edizione, anno, categoria1,  categoria2,  
					categoria3, categoria4, lingua1, lingua2, lingua3, lingua1sigla, lingua2sigla, lingua3sigla, 
                    prefazione, disponibilita, luogo
				FROM libri
			ORDER BY numero ASC
            LIMIT :limite OFFSET :offset";

$stmt = $pdo->prepare($sqlLibri);

$stmt->bindValue(':limite', $perPagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();

$libri = $stmt->fetchAll(PDO::FETCH_ASSOC);


/* Recupero le fotografie di ogni libro */

foreach ($libri as $indice => $libro) {

    $numero = sprintf('%05d', $libro['numero']);

    $foto = glob(__DIR__ . "/libri/{$numero}_[0-9]*.webp") ?: [];

    natsort($foto);

    $libri[$indice]['foto'] = array_map(
        fn($file) => "libri/" . basename($file),
        array_values($foto)
    );
}