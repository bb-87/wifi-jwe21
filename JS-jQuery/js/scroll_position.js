$(window).scroll(function(){
    let scrollPos = $(document).scrollTop();

    console.log(scrollPos);

    $('#scrollBox').html(scrollPos);
    
    if(scrollPos > 600) {
        $('#scrollBox').addClass('show');    
    } else {
        $('#scrollBox').removeClass('show');
    }

    if(scrollPos > 800) {
        $('#scrollBox').css(
            {
            'background-color': 'green',
            'color': 'black'
            }
        );
    } else {
        $('#scrollBox').css(
            {
            'background-color': '',
            'color': ''
            }
        );
    }
});