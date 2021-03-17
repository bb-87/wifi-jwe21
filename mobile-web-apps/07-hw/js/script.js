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
            const name = message.name;
            const text = message.text;

            // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date
            const timestamp = Date.parse(message.timestamp);
            // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl/DateTimeFormat#using_options
            const dateFormat = new Intl.DateTimeFormat('en-AT', {dateStyle: 'long', timeStyle: 'medium'}).format(timestamp);

            li.textContent = `${dateFormat} - ${name}: ${text}`;

            ul.appendChild(li);
        }
    })
    .catch(function (error) {
        console.log(error);
    });
}

setInterval(getMessages, 5000);

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
            document.querySelector('#input-name').value = '';
            document.querySelector('#input-msg').value = '';
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