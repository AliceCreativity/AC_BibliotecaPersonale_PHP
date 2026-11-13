        <footer class="footer mt-auto py-3 bg-light">

            <div class="container">

                <div class="row small">

                    <div class="col-md-6 text-justify">

                        <span class="text-muted">Questo sito è ideato da 
                        <a href="#" target="_blank" class="link-secondary fw-medium">La Bibliotecaria</a>, 
                            e nasce con l'obiettivo di promuovere la lettura e la condivisione dei libri,
                            offrendo uno spazio dedicato a chi desidera dare nuova vita ai propri volumi
                            e contribuire alla libera circolazione della cultura.
                        </span>
                    </div>

                    <div class="col-md-6 text-center text-md-end">

                        <ul class="list-inline mb-0">

                            <li class="list-inline-item">
                                <a href="#" target="_blank" class="text-muted fw-medium">Privacy Policy</a>
                            </li>

                        </ul>

                    </div>

                </div>
            </div>

        </footer>

    </div> <!-- chiude pageContainer -->

    <!-- Script -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dati PHP convertiti in JSON -->
    <script type="application/json" id="datiLibri">
        <?= json_encode($libri, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>
    </script>

    <!-- Legge il Json -->
    <script src="js/libri.js"></script>

</body>

</html>