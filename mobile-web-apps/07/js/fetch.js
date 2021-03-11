// GET auf unseren Server
fetch('http://localhost:3000?search=hans&user=sowieso')
    .then(function(response) {
        if (response.ok) {
            return response.text();
        }
    })
    .then(function(data) {
        console.log(data);
    });

// POST auf unseren Server
const data = {
    message: "hello server"
};

fetch('http://localhost:3000', {
    method: 'POST',
    // Damit der Server weiß, dass der Body dieser Nachricht im Format JSON ist,
    // müssen wir den Content-Type auf 'application/json' setzen. (Ein png Bild hätte z.B. 'image/png')
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(data) // body sendet daten an den server
    // -> '{"message": "hello server"}'
})
    .then(function(response) {
        console.log(response);
    });