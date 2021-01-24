let box = $('#box');
let btn = $('#btn');
let count = 0;

btn.click(
    function() {
        box.addClass('show');
        
        count += 1;
        box.html(count);
        if(count > 98) {
            count = 0;
        }
});

$(window).scroll(function(){
    let scrollPos = $(document).scrollTop();
    console.log(scrollPos);

    if(scrollPos >= 300) {
        box.addClass('circle');
    } else {
        box.removeClass('circle');
    }
});