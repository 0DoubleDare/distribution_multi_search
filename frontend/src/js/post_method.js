const API_URL = "http://localhost/distro_multi_search/backend";

async function registrationUser(form) {
    console.log("register");
    const data = conventForm(form);
    console.log(JSON.stringify(data));
    const user_info = await sendDataToApi(`${API_URL}/registration`, data);
    if (user_info.user_id) {
        console.log("УСПЕШНАЯ РЕГИСТРАЦИЯ");
    }
    console.log(user_info)
}

async function authorizationUser(form) {
    console.log("authorization");
    const data = conventForm(form);
    console.log(JSON.stringify(data))
    const user_info = await sendDataToApi(`${API_URL}/authorization`, data)
    if (user_info.user_id) {
        console.log("УСПЕШНАЯ АВТОРИЗАЦИЯ");
    }
    console.log(user_info);
}

async function insertPost(form) {
    console.log("insert post")
    const data = conventForm(form);
    const response = await sendDataToApi(`${API_URL}/posts/${data.id}`);
    // let response = await fetch(`${API_URL}/posts/${data.id}`, {
    //     method: 'POST',
    // })
}