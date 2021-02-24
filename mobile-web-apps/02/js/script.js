// Queue
const queue = [];

function enqueue(element) {
    queue.push(element);
}

function dequeue() {
    return queue.shift();
}

function onEnqueueButtonClick() {
    const elem = document.querySelector('#enqueue-value').value;

    enqueue(elem);
    showQueue();
}

function onDequeueButtonClick() {
    const elem = dequeue();

    const output = document.querySelector('#dequeue-value');

    if (elem !== undefined) {
        output.classList.remove('warning');
        // entspricht $("#dequeue-value").html("..."):
        output.innerText = 'Wert: ' + elem;
    }
    else {
        output.classList.add('warning');
        output.innerText = 'Eine leere Queue kann kein dequeue!';
    }

    showQueue();
}

function showQueue() {
    showDataStructure('queue', queue);
}

function showDataStructure(id, data_structure) {
    const div = document.querySelector('#' + id);
    div.querySelector('.output').textContent = id + ": " + data_structure.join(', ');
}

document.querySelector('#enqueue-button').addEventListener('click', onEnqueueButtonClick);
document.querySelector('#dequeue-button').addEventListener('click', onDequeueButtonClick);

// Stack
const stack = [];

function push(element) {
    stack.push(element);
}

function pop() {
    return stack.pop();
}

function showStack() {
    showDataStructure('stack', stack);
}

function onPushButtonClick() {
    const inputVal = document.querySelector('#push-value').value;

    push(inputVal);
    showStack();
}

function onPopButtonClick() {
    const elem = pop();

    const output = document.querySelector('#pop-value');

    if (elem !== undefined) {
        output.classList.remove('warning');
        output.innerText = 'Wert: ' + elem;
    } else {
        output.classList.add('warning');
        output.innerText = 'Ein leerer Stack kann kein pop!';
    }

    showStack();
}

document.querySelector('#push-button').addEventListener('click', onPushButtonClick);
document.querySelector('#pop-button').addEventListener('click', onPopButtonClick);