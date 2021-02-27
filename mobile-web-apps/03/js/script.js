let randomList;

function onGenerateClick() {
    let min = parseInt(document.querySelector('#min-value').value);
    let max = parseInt(document.querySelector('#max-value').value);
    let length = parseInt(document.querySelector('#length').value);

    let start = performance.now();
    randomList = new RandomList(min, max, length);
    let generateListTime = performance.now() - start;

    const output = document.querySelector('#generate-output');
    output.textContent = 'Liste erzeugt in ' + generateListTime + ' ms';
}
function onSearchClick() {
    const searchVal = parseInt(document.querySelector('#search-value').value);
    const isInList = randomList.isInList(searchVal);
    const output = document.querySelector('#search-output');

    if (isInList) {
        start = performance.now();
        const n = randomList.count(searchVal);
        const countTime = performance.now() - start;
        output.textContent = searchVal + " wurde " + n + "x gefunden. Suchdauer: " + countTime + " ms";
    } else {
        output.textContent = searchVal + " wurde nicht gefunden.";
    }
}

document.querySelector('#generate').addEventListener('click', onGenerateClick);
document.querySelector('#search').addEventListener('click', onSearchClick);