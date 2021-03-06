// $('body').html('<div id="js-element"></div>');

// = das gleiche wie: 
// document.getElementsByTagName('body').innerHTML = '<div id="neues-js-element"></div>';

console.log('die Seite ist geladen!');


$('#calc').click(
    function() {
        console.log('button clicked');

        let eingabe = $('#input').val();
        let result = eval(eingabe);

        $('#result').val(result);
    }
);


$('#events').on(
    {
        'mouseenter': function() {
            $(this).css(
                {
                    'background-color': 'yellow',
                    'color': 'red'
                }
            );
        },

        'mouseleave': function() {
            $(this).css(
                {
                    'background-color': 'blue',
                    'color': 'white'
                }
            );
        }
    }
);

$('#events2').on(
    {
        'mouseenter': function() {
            $(this).addClass('mouseover');
        },

        'mouseleave': function() {
            $(this).removeClass('mouseover');
        }
    }
);