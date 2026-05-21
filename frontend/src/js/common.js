const API_URL = "http://localhost/distro_multi_search/backend";

async function convertForm(form){
    const data = new FormData(form);
    const popa = Object.fromEntries(data.entries());
    return popa;
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