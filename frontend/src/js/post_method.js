const API_URL = "http://localhost/distro_multi_search/backend";

async function registrationUser(form) {
    console.log("register");
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    console.log(JSON.stringify(data));
    const response = await fetch(`${API_URL}/registration`, {
        method: 'POST',
        headers: {
            'Content-type': 'application/json',
        },
        body: JSON.stringify(data)
    })

    const user_info = await response.json();
    console.log(user_info)
}

async function authorizationUser(form) {
    console.log("authorization");
    const formData = new formData(form);
    const data = Object.fromEntries(formData.entries());
    console.log(JSON.stringify(data))
    const response = await fetch(`${API_URL}/authorization`, {
        method: 'POST',
        headers: {
            'Content-type': 'application/json',
        },
        body: JSON.stringify(data)
    })


}