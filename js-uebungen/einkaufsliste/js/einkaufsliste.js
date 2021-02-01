let shpList = [];
let shpListUnique;
let inputField = $('#shp_value');

$('#shp_btn').click(function() {
    let input = inputField.val();
    let shpListItem = '';

    if (input.length > 0) {
        shpList.push(input);

        shpListUnique = Array.from(new Set(shpList));

        $(shpListUnique).each(function(index, element) {
            shpListItem += `<li><button class="check-btn"><img src="img/check.png" alt="checkmark icon"></button>${element}<button class="remove-btn"><img src="img/remove.png" alt="remove icon"></button></li>`;
            $('#shp_list').html(shpListItem);
        });
    } else {
        console.warn('Artikel ohne Namen können nicht hinzugefügt werden!');
    }

    itemCount();
    checkItem();
    removeItem();

    inputField.val('');
});

inputField.keyup(function(e) {
    if (e.keyCode === 13) {
        let input = inputField.val();
        let shpListItem = '';

        if (input.length > 0) {
            shpList.push(input);

            shpListUnique = Array.from(new Set(shpList));

            $(shpListUnique).each(function(index, element) {
                shpListItem += `<li><button class="check-btn"><img src="img/check.png" alt="checkmark icon"></button>${element}<button class="remove-btn"><img src="img/remove.png" alt="remove icon"></button></li>`;
                $('#shp_list').html(shpListItem);
            });
        } else {
            console.warn('Artikel ohne Namen können nicht hinzugefügt werden!');
        }

        itemCount();
        checkItem();
        removeItem();

        inputField.val('');
    }
});

function itemCount() {
    if (shpListUnique.length > 0) {
        let itemCountVal = shpListUnique.length;
        $('#item-count').html(`Anzahl der Artikel: ${itemCountVal}`);
    }
}

function checkItem() {
    $('button.check-btn').click(function() {
        $(this).parent().toggleClass('checked');
    });
}

function removeItem () {
    $('button.remove-btn').click(function() {
        $(this).parent().remove();
    });
}