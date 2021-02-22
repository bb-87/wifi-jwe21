let namen = [
    'Robert',
    'Jasmin',
    'Ulvi'
];

/*
// Fix definierte Anzahl an loops
for (let i = 0; i < 3; i++) {
    // console.log('hey' + i);

    let html = '<img src="https://placehold.it/300x200?text=' + namen[i] + '" class=bild-' + i + '">';

    console.log(html);

    document.getElementById('gallery').innerHTML += html;

    // document.getElementById('gallery').innerHTML = document.getElementById('gallery').innerHTML + html;
}
*/


// Ausgabe eines Arrays, ohne die Anzahl der Array-Elemente zu kennen
namen.forEach(element => {
    console.log(element);

    let html = '<img src="https://placehold.it/300x200?text=' + element + '">';

    document.getElementById('gallery').innerHTML += html;
});