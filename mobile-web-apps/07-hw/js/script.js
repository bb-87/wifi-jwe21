// Chat API: https://github.com/allesmi/mobile-web-apps-2021/blob/main/src/07/README.md

function getMessages() {
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

            li.textContent = `${timestamp} - ${name}: ${text}`;

            ul.appendChild(li);
        }
    })
    .catch(function (error) {
        console.log(error);
    });
}

function postMessage() {
    const inputName = document.querySelector('#input-name').value;
    const inputMsg = document.querySelector('#input-msg').value;

    const postMsg = {
        name: inputName,
        text: inputMsg
    };

    fetch('https://test.sunbeng.eu/api/messages', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(postMsg)
    })
    .then(function(response) {
        if (response.ok) {
            getMessages();
        } else {
            throw new Error('Error posting message');
        }
    })
    .catch(function(error) {
        console.log(error);
    });
}

document.querySelector('#output-btn').addEventListener('click', getMessages);
document.querySelector('#input-btn').addEventListener('click', postMessage);

// TODO: parse timestamp