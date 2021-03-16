// Chat API: https://github.com/allesmi/mobile-web-apps-2021/blob/main/src/07/README.md

function getMessages(event) {
    fetch('https://test.sunbeng.eu/api/messages')
    .then(function(response) {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('API error');
        }
    })
    .then(function(messages) {
        // console.log(messages);
        const ul = document.querySelector('#output-ul');
        ul.textContent = '';

        for (let message of messages) {
            const li = document.createElement('li');
            const timestamp = message.timestamp;
            const name = message.name;
            const text = message.text;

            li.innerHTML = `${timestamp} - <strong>${name}:</strong> ${text}`;

            ul.appendChild(li);
        }
    });
}

function postMessage(event) {
    const inputName = document.querySelector('#input-name').value;
    const inputMsg = document.querySelector('#input-msg').value;

    const postMsg = {
        name: inputName,
        text: inputMsg
    }

    fetch('https://test.sunbeng.eu/api/messages', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(postMsg)
    })
    .then(function(response) {
        console.log(response);
    });
}

document.querySelector('#output-btn').addEventListener('click', getMessages);
document.querySelector('#input-btn').addEventListener('click', postMessage);