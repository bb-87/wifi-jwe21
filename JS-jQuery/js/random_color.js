let farben = [
    'yellow',
    'brown',
    'deepred',
    'green',
    'orange'
];

function randomColor() {
    let zufallszahl = Math.floor(Math.random() * farben.length);

    return farben[zufallszahl];
}

$('button.random').click(
    function() {
        $('#farbe').css({
            'background-color': randomColor() 
        });
    }
)

/*
    Notizen:
    Math.floor() rundet ganzzahlig ab
    ( Math.ceil() rundet ganzzahlig auf )
    ( Math.round() rundet kaufmännisch ganzzahlig ab oder auf )
    Math.random() erzeugt eine zufällige Zahl zwischen 0 und 1 
*/