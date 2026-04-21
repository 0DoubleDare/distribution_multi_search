<div class="card shadow-sm mb-4 mx-auto">
    <!-- Шапка и тело остаются прежними -->
    <div class="card-header bg-white border-0 d-flex align-items-center justify-content-between py-3">
        <div class="d-flex align-items-center">
            <a href="/" class="me-0">
                <img src="<?= htmlspecialchars($post['user_avatar'] ?? '../storage/default_avatar.webp') ?>" class="rounded-circle me-3" alt="Avatar" width="45" height="45">
            </a>
            <div>
                <h6 class="mb-0 fw-bold"><?= htmlspecialchars($post['user_display_name'] ?? '') ?></h6>
                <small class="text-muted"><?= htmlspecialchars($post['post_created_at']) ?></small>
            </div>
        </div>
        <div>
            <span class="badge rounded-pill bg-success text-light fs-6"><?= htmlspecialchars($post['category']) ?></span>
            <span class="badge bg-info text-dark fs-6"><?= htmlspecialchars($post['distro_name']) ?></span>
        </div>
    </div>

    <div class="card-body py-2">
        <h5 class="card-title fw-bold"><?= htmlspecialchars($post['title']) ?></h5>
        <p class="card-text text-secondary"><?= htmlspecialchars($post['content']) ?></p>
    </div>

    <!-- Футер с кнопками взаимодействия -->
    <div class="card-footer bg-white border-top-0 d-flex align-items-center py-3">
        <div class="btn-group me-3" role="group">
            <button type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-hand-thumbs-up"></i> 42</button>
            <button type="button" class="btn btn-outline-danger btn-sm"><i class="bi bi-hand-thumbs-down"></i> 3</button>
        </div>
        <!-- Кнопка развертывания комментариев (опционально) -->
        <button class="btn btn-link btn-sm text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#comments-<?= $post['post_id'] ?>">
            <i class="bi bi-chat-left-text"></i> Комментарии
        </button>
    </div>

    <!-- Секция комментариев -->
    <div class="collapse show" id="comments-<?= $post['post_id'] ?>">
        <div class="card-body border-top bg-light">

            <!-- Список комментариев (цикл) -->
            <div class="comment-list mb-3">
                <?php
                foreach ($comments as $comment):
                    if ($comment['post_id'] == $post['post_id']):
                ?>
                <div class="d-flex mb-2">
                    <img src="../storage/default_avatar.webp" class="rounded-circle me-2" width="30" height="30">
                    <div class="bg-white p-2 rounded shadow-sm w-100">
                        <div class="d-flex justify-content-between">
                            <small class="fw-bold"><?= $comment['display_name'] ?></small>
                            <small class="text-muted"><?= $comment['comment_created_at'] ?></small>
                        </div>
                        <small class="text-dark"><?= $comment['content']?></small>
                    </div>
                </div>
                <?php endif;?>
                <?php endforeach; ?>
            </div>

            <!-- Форма добавления -->
            <?php if (isset($_SESSION['user_info']['user_id'])): ?>
                <form action="../controller/add_comment.php" method="POST" class="d-flex gap-2">
                    <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                    <input type="text" name="content" class="form-control form-control-sm" placeholder="Напишите ответ..." required>
                    <button type="submit" class="btn btn-primary btn-sm px-3">OK</button>
                </form>
            <?php endif; ?>

        </div>
    </div>
</div>

