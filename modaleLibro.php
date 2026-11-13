<!-- Modale Libro -->

<div id="modaleLibro" class="modal fade modaleLibro" tabindex="-1" aria-labelledby="modalLibroLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-dark text-light py-2">

                <h4 id="modaleLibroLabel" class="modal-title h5 modaleLibroLabel"></h4>

                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Chiudi">
                </button>

            </div>

            <div class="modal-body">

                <!-- Galleria fotografie -->
                <div id="galleriaLibro" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3 justify-content-center galleriaLibro">
                </div>

                <!-- Prefazione -->
                <p id="prefazioneLibro" class="mt-4 pt-3 mb-0 border-top prefazioneLibro"></p>

            </div>

            <div class="modal-footer">

                <!-- Autore, editore, anno ed edizione -->
                <div class="me-auto">
                    <h5 id="informazioniLibro" class="informazioniLibro h6"></h5>
                </div>

                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                    Chiudi
                </button>

            </div>

        </div>

    </div>

</div>


<!-- Lightbox -->

<dialog id="lightboxLibro" class="p-0 border-0 lightboxLibro" aria-label="Fotografia ingrandita">

    <div id="contenutoLightbox" class="position-relative d-flex align-items-center justify-content-center w-100 h-100 contenutoLightbox">

        <!-- Chiudi -->
        <button type="button" id="chiudiLightbox" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 chiudiLightbox" aria-label="Chiudi fotografia">
        </button>

        <!-- Freccia sinistra -->
        <button type="button" id="fotoPrecedente" class="btn btn-light rounded-circle position-absolute start-0 top-50 translate-middle-y ms-3 fotoPrecedente" aria-label="Fotografia precedente">
            &#10094;
        </button>

        <!-- Fotografia -->
        <img id="immagineLightbox" class="object-fit-contain immagineLightbox" alt="">

        <!-- Freccia destra -->
        <button type="button" id="fotoSuccessiva" class="btn btn-light rounded-circle position-absolute end-0 top-50 translate-middle-y me-3 fotoSuccessiva" aria-label="Fotografia successiva">
            &#10095;
        </button>

        <!-- Contatore -->
        <span id="contatoreLightbox" class="position-absolute bottom-0 start-50 translate-middle-x text-white pb-3 contatoreLightbox">
        </span>

    </div>
</dialog>