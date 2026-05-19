const API_URL = "http://localhost/distro_multi_search/backend";

async function getDistroList() {
    let res = await fetch(`${API_URL}/distros`);
    let list = await res.json();
    console.log(list);
    list.forEach((dist) => {
        document.querySelector(".distro-list").innerHTML += `
            <div class="col">
                <div class="card h-100">
                    <a href="./controller/forum.php?id=${dist.id}" class="go-to-distro-wiki d-block">
                        <img src="style/images/${dist.icon_name}.png"
                             class="distro-card-image" 
                             alt="${dist.icon_name}"
                             style="width: 128px; height: 128px; object-fit: contain;">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">${dist.name}</h5>
                        <small class="card-text">${dist.description}</small>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <small class="text-body-secondary"> Количество постов: ${dist.posts_count}</small>
                        <a href="${dist.official_wiki_url}" class="text-body-secondary opacity-50">Wiki</a>
                    </div>
                </div>
            </div> 
        `;
    });
}

async function getPostsByDistroIdAndCategory(id, session, category = -1) {
    console.log(`GET: Posts by id (${id})`);
    console.log(session);

    let res = await fetch(`${API_URL}/posts/${id}`);
    let posts = await res.json();
    const isAuth = session && session.user_id;

    const postsContainer = document.querySelector(".posts");
    postsContainer.innerHTML = "";

    for (const post of posts) {
        // console.log(post);

        let post_comments = await fetch(`${API_URL}/comments/${post.post_id}`);
        let comments = await post_comments.json();

        const commentsHtml = comments.map(comment => `
             <div class="d-flex mb-2">
                <img src="../storage/default_avatar.webp" class="rounded-circle me-2" width="30" height="30">
                    <div class="bg-white p-2 rounded shadow-sm w-100">
                        <div class="d-flex justify-content-between">
                         <small class="fw-bold">${comment.display_name}</small>
                         <small class="text-muted">${comment.comment_created_at}</small>
                     </div>
                     <small class="text-dark">${comment.content}</small>
                 </div>
             </div>
         `).join("");

        if (session.user_info) {
            console.log(session)
        }
        // console.log(isAuth);
        const formHtml = isAuth ? `
           <form action="../controller/add_comment_to_post.php?id=${id}" method="POST" class="d-flex gap-2">
                 <input type="hidden" name="post_id" value="${post.post_id}">
                 <input type="text" name="content" class="form-control form-control-sm" placeholder="Напишите ответ..." required>
                <button type="submit" class="btn btn-primary btn-sm px-3">Оставить комментарий</button>
             </form>
         ` : "";

        postsContainer.innerHTML += `
            <div class="card shadow-sm mb-4 mx-auto">
                <div class="card-header bg-white border-0 d-flex align-items-center justify-content-between py-3">
                    <div class="d-flex align-items-center">
                        <a href="/" class="me-0">
                            <img src="${post.user_avatar ?? '../storage/default_avatar.webp'}" class="rounded-circle me-3" alt="Avatar" width="45" height="45">
                        </a>
                         <div>
                           <h6 class="mb-0 fw-bold">${post.user_display_name ?? ''}</h6>
                            <small class="text-muted">${post.post_created_at ?? ""}</small>
                         </div>
                     </div>
                     <div>
                         <span class="badge rounded-pill bg-success text-light fs-6">${post.category}</span>
                       <span class="badge bg-info text-dark fs-6">${post.distro_name ?? "Общее"}</span>
                    </div>
               </div>
    
                 <div class="card-body py-2">
                     <h5 class="card-title fw-bold">${post.title}</h5>
                     <p class="card-text text-secondary">${post.content}</p>
                 </div>
    
                 <div class="collapse show" id="comments-${post.post_id}">
                     <div class="card-body border-top bg-light">
                        <div class="comment-list mb-3">
                             ${commentsHtml}
                         </div>
                         ${formHtml}
                     </div>
                 </div>
             </div>
         `;
     }
}

async function getCommentByPostId(id) {
    // TODO: Разделить логику
}
async function getPostsCategories() {
    let response = await fetch(`${API_URL}/categories`)
    let categories = await response.json();
    console.log("Категории поста: ", categories);
    categories.forEach((category) => {
        document.querySelector(".select-category").innerHTML += `
            <option value="${category.id}">${category.name}</option> 
        `
    });
}
