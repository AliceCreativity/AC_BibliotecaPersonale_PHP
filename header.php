<?php

    require('connection.php');
	
?>

<!DOCTYPE html>

<html lang="it">

<head>

	<?php
	
		if ($test !== true) :
		
	?>
	
	<!-- Iubenda -->
	
	<!-- <script type="text/javascript" src="https://embeds.iubenda.com/widgets/801382a5-99e2-4c7d-b271-d040cdb304fa.js"></script> -->
	
	<?php endif; ?>	


	<!-- Sito -->

	<meta name="description" content=" La Biblioteca di Casa McLaud - Elenco libri biblioteca personale">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	
	<meta charset="utf-8">

	<title> Biblioteca Personale <?= $tipoPagina === 'home' ? '' : ' | ' . htmlspecialchars($pagina['Nome'], ENT_QUOTES, 'UTF-8') ?> </title>

	<link rel="shortcut icon" href="img/favico.png" type="image/png" class="miniatura">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
    <!-- Stile -->
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

	<div class="d-flex flex-column min-vh-100 w-100" id="pageContainer">

        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">

            <div class="container d-flex flex-row justify-content-between">

                <div>
                    <div class="navbar-brand logo d-flex flex-row align-items-center">
                        <img src="img/books1.png" alt="BrandName" class="me-2">
                        <span class="fs-3 fw-medium text-wrap">Biblioteca Personale</span>
                    </div>
                </div>

                <div>
                    <button class="navbar-toggler border border-black border-2 rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse flex-grow-0" id="navbarNav">

                    <ul class="navbar-nav ms-lg-auto d-flex flex-row justify-content-around">

                        <li class="nav-item ms-3">
                            <a class="nav-item nav-link d-flex flex-column align-items-center active" href="index.php">
                                <img src="img/books2.png" class="menu-icon mb-1" alt="">                            
                                <span class="fw-medium">Home</span>
                            </a>
                        </li>

                        <li class="nav-item ms-3">
                            <a class="nav-item nav-link d-flex flex-column align-items-center" href="libri.php">
                                <img src="img/books3.png" class="menu-icon mb-1" alt="">
                                <span class="fw-medium">Libri</span>
                            </a>
                        </li>

                        <li class="nav-item ms-3">
                            <a class="nav-item nav-link d-flex flex-column align-items-center" href="contatti.php">
                                <img src="img/person.png" class="menu-icon mb-1" alt="">
                                <span class="fw-medium">Contatti</span>
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

        </nav>

        <header>

        	<h1 class="text-center mt-5 mb-4"> 
        		Titolo pagina
        	</h1>

        </header>
        
        <main class="mb-4">

            <div class="container d-flex flex-column">

         