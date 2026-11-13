/** Costanti **/

/* Recupero i libri dal JSON */

const libri = JSON.parse(
    document.getElementById("datiLibri").textContent
);

/* Elementi della modale */

const modale = document.getElementById("modaleLibro");
const galleria = document.getElementById("galleriaLibro");

/* Elementi del lightbox */

const lightbox = document.getElementById("lightboxLibro");
const immagineLightbox = document.getElementById("immagineLightbox");


/** Gestione modale **/

/* Apertura */

modale.addEventListener("show.bs.modal", function(evento) 
{
    // Individuo il libro selezionato
    const numero = Number(evento.relatedTarget?.dataset.numero);

    const libro = libri.find(item => Number(item.numero) === numero);

    if (!libro) 
    {
        evento.preventDefault();

        return;
    }

    // Titolo
    document.getElementById("modaleLibroLabel").textContent = libro.titolo ?? "";

    // Informazioni
    document.getElementById("informazioniLibro").textContent = `${libro.autore ?? ""}, ${libro.editore ?? ""}, ${libro.edizione + '°  ed.' ?? ""}, ${libro.anno ?? ""}`;

    // Prefazione
    document.getElementById("prefazioneLibro").textContent = libro.prefazione ?? "";

    // Svuoto la galleria
    galleria.replaceChildren();

    // Creo le miniature
    (libro.foto ?? []).forEach((percorso, indice) => 
    {
        const colonna = document.createElement("div");
        colonna.className = "col text-center";

        const pulsante = document.createElement("button");
        pulsante.type = "button";
        pulsante.className = "btn p-0 border-0";
        pulsante.setAttribute(
            "aria-label",
            `Ingrandisci fotografia ${indice + 1}`
        );

        const immagine = document.createElement("img");
        immagine.src = percorso;
        immagine.alt = `Fotografia ${indice + 1} di ${libro.titolo}`;
        immagine.className = "img-fluid";
        immagine.loading = "lazy";

        // Apertura lightbox
        pulsante.addEventListener("click", function() 
        {        
            fotoLightbox = libro.foto ?? [];
            indiceLightbox = indice;
            titoloLightbox = libro.titolo ?? "";
        
            mostraFoto();
            lightbox.showModal();
        
        });

        pulsante.appendChild(immagine);
        colonna.appendChild(pulsante);
        galleria.appendChild(colonna);

    });

    if (!libro.foto?.length) 
    {
        galleria.textContent = "Nessuna fotografia disponibile.";
    }

});

/* Navigazione lightbox */

let fotoLightbox = [];
let indiceLightbox = 0;
let titoloLightbox = "";

/* Visualizzazione fotografia corrente */

function mostraFoto() 
{
    immagineLightbox.src = fotoLightbox[indiceLightbox];
    immagineLightbox.alt = `Fotografia ${indiceLightbox + 1} di ${titoloLightbox}`;

    document.getElementById("contatoreLightbox").textContent =
        `${indiceLightbox + 1} / ${fotoLightbox.length}`;

    // Nascondo la freccia sinistra sulla prima foto
    document.getElementById("fotoPrecedente").classList.toggle(
        "d-none", indiceLightbox === 0
    );

    // Nascondo la freccia destra sull'ultima foto
    document.getElementById("fotoSuccessiva").classList.toggle(
        "d-none", indiceLightbox === fotoLightbox.length - 1
    );
}

/* Cambio fotografia */ 

function cambiaFoto(direzione) 
{
    const nuovoIndice = indiceLightbox + direzione;

    // Non permetto di uscire dai limiti dell'array
    if (nuovoIndice < 0 || nuovoIndice >= fotoLightbox.length) 
    {
        return;
    }

    indiceLightbox = nuovoIndice;

    mostraFoto();
}

/* Pulsanti di navigazione */

document.getElementById("fotoPrecedente").addEventListener("click", function() {
    cambiaFoto(-1);
});

document.getElementById("fotoSuccessiva").addEventListener("click", function() {
    cambiaFoto(1);
});

/* Chiusura lightbox tramite pulsante */

document.getElementById("chiudiLightbox")
    .addEventListener("click", function() {
        lightbox.close();
    });

/* Chiusura lightbox cliccando sullo sfondo */

document.getElementById("contenutoLightbox")
    .addEventListener("click", function(evento) {
        if (evento.target === this) {
            lightbox.close();
        }
    });

/* Evitare che Escape chiuda anche la modale del libro */

lightbox.addEventListener("keydown", function(evento) {
    if (evento.key === "Escape") {
        evento.stopPropagation();
    }
});




