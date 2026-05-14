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

async function getPostsBiDistroId(id) {
    let res = await fetch(`${API_URL}/posts/${id}`);
    let posts = await res.json();
    console.log(posts);
    posts.forEach((post) => {`
    
    `});
}

