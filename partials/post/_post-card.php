<div class="mb-4 col-md-4 col-sm-6">
    <div class="card shadow-sm">
        <img src="<?= 'uploads/posts/'.$post['image'] ?>"
             alt="<?= $post['title'] ?>" class="img-fluid">
        <div class="card-body">
            <h5 class="card-title"><?= $post['title'] ?></h5>
            <small class="text-muted">Rédigé par : <a href="auteur.php?username=<?= $post['username'] ?>"><?= $post['username'] ?></a> - le <?= date('d/m/Y à H:i', strtotime($post['createdAt'])) ?></small>
            <p class="card-text"><?= summarize($post['content']) ?></p>
            <a href="<?= $post['id_post'] ?>_<?= $post['slug'] ?>" class="btn w-100 btn-outline-primary">Lire la suite</a>
        </div>
    </div>
</div>
