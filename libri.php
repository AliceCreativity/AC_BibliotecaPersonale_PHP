<?php

    require('header.php');

?>
        
    <main class="mb-4">

        <header>
        
            <h1 class="text-center mt-5 mb-4"> 
            	Libri
            </h1>
        
        </header>

        <div class="container d-flex flex-column">

            <div class="col-lg-12 my-3 mx-auto text-justify">

                <p>
                    Clicca sul nome del libro per vedere la copertina.
               </p>

            </div>

            <div class="col-lg-12 border border-dark rounded-3 overflow-hidden mx-auto">

                <table class="tabellaLibri table table-light table-striped mb-0" id="tabellaLibri">

                    <thead>

                        <tr class="table-dark">
                          <th scope="row">N°</th>
                          <th scope="col">Titolo</th>
                          <th scope="col">Autore</th>
                          <th scope="col">Editore</th>
                          <th scope="col" class="colIndicatore">Ed.</th>
                          <th scope="col" class="text-center">Anno</th>
                          <th scope="col">Categoria</th>
                          <th scope="col" class="colIndicatore">L</th>
                          <th scope="col" class="colIndicatore">V</th>
                        </tr>

                    </thead>

                    <tbody id="tBodytabellaLibri">

                        <?php foreach ($libri as $libro): ?>
                                                    
                            <tr>
                                <th scope="row"><?= htmlspecialchars($libro['numero']) ?></th>
                                <td>
                                    <span class="titoloLibro link-dark" data-bs-target="#modaleLibro" data-bs-toggle="modal" data-numero="<?= (int)$libro['numero'] ?>"  role="button" tabindex="0">
                                        <?= htmlspecialchars($libro['titolo']) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($libro['autore']) ?></td>
                                <td><?= htmlspecialchars($libro['editore']) ?></td>
                                <td><?= htmlspecialchars($libro['edizione'] . '°') ?></td>
                                <td class="text-center"><?= htmlspecialchars($libro['anno']) ?></td>
                                <td>
                                    <?= htmlspecialchars(implode(', ', 
                                                          array_filter([
                                                                $libro['categoria1'],
                                                                $libro['categoria2'],
                                                                $libro['categoria3'],
                                                                $libro['categoria4']
                                                          ]))) ?>
                                </td>
                                <td class="colIndicatore"><?= htmlspecialchars($libro['lingua1sigla']) ?></td>
                                <td class="colIndicatore">
                                     <img src="img/<?= (int)$libro['disponibilita'] === 1 ? 'avaible_red.png' : 'unavaible_red.png' ?>" alt="<?= (int)$libro['disponibilita'] === 1 ? 'Disponibile' : 'Non disponibile' ?>" title="<?= (int)$libro['disponibilita'] === 1 ? 'Disponibile' : 'Non disponibile' ?>" class="iconaDisponibilita">
                                </td>
                            </tr>
                        
                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

            <!-- Paginazione libri -->

            <?php if ($totalePagine > 1): ?>
            
                <nav class="mt-4" aria-label="Paginazione libri">
            
                    <ul class="pagination justify-content-center flex-wrap">
            
                        <!-- Pagina precedente -->
                        <?php if ($pagina > 1): ?>
                        
                            <li class="page-item">
                                <a class="page-link" href="?pagina=<?= $pagina - 1 ?>">
                                    &laquo; Precedente
                                </a>
                            </li>
                        
                        <?php endif; ?>
                        
                        
                        <!-- Numeri di pagina -->
                        <?php
            
                            $inizio = max(1, $pagina - 2);
                            $fine = min($totalePagine, $pagina + 2);
                        
                        ?>
            
                        <?php for ($i = $inizio; $i <= $fine; $i++): ?>
                        
                            <li class="page-item <?= $i === $pagina ? 'active' : '' ?>">
                                <a class="page-link" href="?pagina=<?= $i ?>" <?= $i === $pagina ? 'aria-current="page"' : '' ?>>
                                    <?= $i ?>
                                </a>
                            </li>
                        
                        <?php endfor; ?>
                        
                        
                        <!-- Pagina successiva -->
                        <?php if ($pagina < $totalePagine): ?>
                        
                            <li class="page-item">
                                <a class="page-link" href="?pagina=<?= $pagina + 1 ?>">
                                    Successiva &raquo;
                                </a>
                            </li>
                        
                        <?php endif; ?>
                        
                    </ul>
                        
                </nav>
                        
            <?php endif; ?>

        </div> <!-- chiude container -->

    </main>

<?php

    include "modaleLibro.php";

    require('footer.php');

?>