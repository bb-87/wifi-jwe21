let box = $('#box');
let btn = $('#btn');
let count = 0;

let animationComplete = false;

btn.click(
    function() {
        if (animationComplete == false) {
            animationComplete = true;

            box.animate({
                width: '+=250',
                height: '+=250'
            }, 2000, 'linear', function() {
                count += 1;
                box.html(count);
            });
        } else {
            count += 1;
            box.html(count);
            if (count > 98) {
                count = 0;
            }
        }
    }
);

$(window).scroll(function () {
    let scrollPos = $(document).scrollTop();
    console.log(scrollPos);

    if (scrollPos >= 300) {
        box.addClass('circle');
    } else {
        box.removeClass('circle');
    }
});