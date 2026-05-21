async function registrationUser(data) {
    console.log("register");
    console.log(JSON.stringify(data));

    const user_info = await sendDataToApi(`${API_URL}/registration`, data);
    if (user_info.user_id) {
        console.log("УСПЕШНАЯ РЕГИСТРАЦИЯ");
        return true;
    }

    console.log(user_info)
    return false;
}

async function authorizationUser(data) {
    console.log("authorization");
    console.log(JSON.stringify(data))

    const response = await sendDataToApi(`${API_URL}/authorization`, data)
    console.log(response);

    if (response.user_id) {
        console.log("УСПЕШНАЯ АВТОРИЗАЦИЯ");
        return true;
    }
    return false;
}

async function insertPost(data) {
    console.log("insert post")
    // const data = conventForm(data);
    const response = await sendDataToApi(`${API_URL}/posts/${data.distribution_id}`, data);

    console.log(response);
    if (response.id) {
        return true;
    }
    return false;
}

async function insertCommentToPost(data) {
    console.log("insert comment")
    const response = await sendDataToApi(`${API_URL}/comments/${data.post_id}`, data)

    console.log(response);
}