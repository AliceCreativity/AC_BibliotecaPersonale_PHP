<?php

    require('header.php');

    include('modal.php');

?>

            <div class="col-lg-12 my-3 mx-auto text-justify">

                <p>
                    Clicca sul nome del libro per vedere la copertina.
                </p>

            </div>

            <div class="col-lg-12 border border-black rounded-3 overflow-hidden mx-auto">

                <table class="tabellaLibri table table-light table-striped mb-0" id="tabellaLibri">

                    <thead>

                        <tr class="table-dark">
                          <th scope="row">N°</th>
                          <th scope="col">Titolo</th>
                          <th scope="col">Autore</th>
                          <th scope="col">Edizioni</th>
                          <th scope="col" class="text-center">Anno</th>
                          <th scope="col">Categoria</th>
                          <th scope="col" class="colIndicatore">L</th>
                          <th scope="col" class="colIndicatore">V</th>
                        </tr>

                    </thead>

                    <tbody id="tBodytabellaLibri">
                        
                        <tr>
                            <th scope="row">20.000</th>
                            <td>
                                <span class="titoloLibro" data-bs-toggle="modal" data-bs-target="#modaleLibro" role="button" tabindex="0">
                                    Il Gabbiano Jonathan Livingston
                                </span>
                            </td>
                            <td>Richard Bach</td>
                            <td>Rizzoli</td>
                            <td class="text-center">2022</td>
                            <td>Romanzi, Crescita personale, Filosofia</td>
                            <td class="colIndicatore">IT</td>
                            <td class="colIndicatore">V</td>
                        </tr>
                        
                        <tr>
                            <th scope="row">30.000</th>
                            <td>
                                <span data-toggle="modal" data-target="#modalLibri" class="link-dark">
                                    Messaggio per un'Aquila che si crede un Pollo
                                </span>
                            </td>
                            <td>Anthony De Mello</td>
                            <td>Piemme</td>
                            <td class="text-center">2024</td>
                            <td>Satira, Crescita personale, Filosofia</td>
                            <td class="colIndicatore">IT</td>
                            <td class="colIndicatore">X</td>
                        </tr>

                    </tbody>

                </table>

            </div> 


<?php

    require('footer.php');

?>