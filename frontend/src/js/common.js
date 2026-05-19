
async function conventForm(form){
    const formData = new FormData(form);
    return Object.fromEntries(formData.entries());
}

async function sendDataToApi(url, data) {
    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    return await response.json();
}