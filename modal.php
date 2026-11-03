<!-- <?php
    $percorso = "libri/" . $numero . ".webp";
?> -->

<!-- Modale Libro -->

<div class="modal fade modaleLibro col-lg-12 border border-black rounded-3" id="modaleLibro" tabindex="-1" role="dialog" aria-labelledby="" data-toggle="modal" data-target="modalLibriLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

          <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Titolo libro </h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
          </div>

          <div class="modal-body">

                <img src="libri/10000.webp" class="img-fluid" alt="Copertina del libro">

                <!-- <?php if (is_file($percorso)): ?>

                    <img src="<?= htmlspecialchars($percorso) ?>" class="img-fluid" alt="Copertina del libro">

                <?php endif; ?> -->

          </div>

          <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" aria-label="Close">Chiudi</button>
          </div>

        </div>

    </div>
</div>