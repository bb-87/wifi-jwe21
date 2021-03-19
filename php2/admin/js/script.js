function newRecipe() {
    const block = document.querySelector('.ingredient-list .ingredient-block');
    const newBlock = block.cloneNode(true);
    document.querySelector('.ingredient-list').appendChild(newBlock);

    newBlock.querySelector('select').value = '';
    newBlock.querySelector('input[name="menge[]"]').value = '';
    newBlock.querySelector('input[name="einheit[]"]').value = '';

    // ID-Duplikate vermeiden
    const rand = (new Date()).getTime();
    newBlock.querySelector('label[for="zutaten_id"]').setAttribute("for", "zutaten_id_"+rand);
    newBlock.querySelector('select[id="zutaten_id"]').setAttribute("id", "zutaten_id_"+rand);
    newBlock.querySelector('label[for="menge"]').setAttribute("for", "menge_"+rand);
    newBlock.querySelector('input[id="menge"]').setAttribute("id", "menge_"+rand);
    newBlock.querySelector('label[for="einheit"]').setAttribute("for", "einheit_"+rand);
    newBlock.querySelector('input[id="einheit"]').setAttribute("id", "einheit_"+rand);
}