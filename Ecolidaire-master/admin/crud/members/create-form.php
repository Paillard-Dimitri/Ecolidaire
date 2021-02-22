<?php
require_once __DIR__ . "/../../../model/database.php";

$members = getAllRows("member");

require_once __DIR__ . "/../../layout/header.php"; ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Ajouter un membre</h1>
    </div>
    <form method="post" action="create-query.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="firstname" class="form-control" placeholder="Titre" required>
        </div>
        <div class="form-group">
        </div>
        <div>
            <label>Prénom</label>
            <input type="text" name="lastname" class="form-control" placeholder="Titre" required>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="picture" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">
            <i class="fa fa-check"></i>
            Ajouter
        </button>
    </form>

<?php require_once __DIR__ . "/../../layout/footer.php"; ?>