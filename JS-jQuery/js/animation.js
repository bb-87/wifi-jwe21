let box = $('.animatedBox');

box.animate(
    {
        opacity: '.3',
        height: '+=100px',
        left: '-=100px'
    }, 
    1000, 
    'linear', 
    function() {
        console.log('Animation abgeschlossen');
    }
);

box.animate(
    {
        width: '+=300px'
    }, 
    1000
);