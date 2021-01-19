// Liste der Bildnamen in array
let images = [
    '001',
    '002',
    '003',
    '004',
    '005',
    '006',
    '007',
    '008',
    '009',
    '010'
];

let gallery = $('#gallery');

// html-code für das vergrößerte Bild
let lightboxContainer  = $('<div id="lightbox" class="hide"><span class="close">X</span><div class="lightbox-inner"></div></div>');

$('body > .wrapper').append(lightboxContainer);

// Ausgabe der Thumbs
// https://api.jquery.com/each/
$(images).each(
    function(index, element) {
        // img tag für thumbnails
        let htmlImageTag = `<img class="thumb" src="img/thumbs/${element}.jpg" alt="">`;

        // img link zum original bild
        htmlImageTag = `<a href="img/original/${element}.jpg"> ${htmlImageTag} </a>`;

        // gallery.html(htmlImageTag); // ersetzt
        gallery.append(htmlImageTag); // fügt hinzu
        // console.log(htmlImageTag);
    }
);

// event handler für klick auf das Thumbnail
$('#gallery a').click(
    function(event) {
        event.preventDefault(); // Default Browserverhalten bei Klick unterdrücken
        let urlToOriginalImg = $(this).attr('href');
        lightboxContainer.find('.lightbox-inner').html(`<img src="${urlToOriginalImg}" alt="">`);
        lightboxContainer.removeClass('hide');

    }
);

// bei Klick neben Bild hide-Klasse hinzufügen
lightboxContainer.click(function(e) {

    let image = lightboxContainer.find('img');

    if(!$(e.target).is(image)) {
        lightboxContainer.addClass('hide'); 
    }
});

/*
// bei Klick auf span X hide-Klasse wieder entfernen
$('#lightbox span.close').click(
    function(event) {
        lightboxContainer.addClass('hide');
    }
);
*/

// Ausblenden des Lightbox Containers beim Drücken der ESC Taste
$(document).keyup(function(e) {
    // Keycode für Escape
    if(e.keyCode == 27) {
        lightboxContainer.addClass('hide'); 
    }
});