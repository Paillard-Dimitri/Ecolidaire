<?php
require_once __DIR__ . "/../../../model/database.php";

$id = $_GET["id"];
$projects = getAllProjectByMember("project", $id);
$categories = getAllRows("category");
$members = getAllRows("member");

require_once __DIR__ . "/../../layout/header.php";
?>

    <h1>Modifier le projet</h1>

    <form method="post" action="update-query.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Titre</label>
            <input type="text" name="label" maxlength="255" value="<?= $projects["title"]; ?>" class="form-control" placeholder="Libellé" required>
        </div>
        <input type="hidden" name="id" value="<?= $projects["id"]; ?>">
        <div class="form-group">
            <label>Catégorie</label>
            <select name="category_id" class="form-control">
                <?php foreach ($projects as $project) : ?>
                    <option value="<?= $project["id"]; ?>">
                        <?= $project["category_id"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="picture" value="<?= $projects["picture"]; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"><?= $projects["description"]; ?></textarea>
        </div>
        <div class="form-group">
            <label>Prix</label>
            <input type="number" name="price" value="<?= $projects["price"]; ?>" class="form-control" placeholder="Prix" required>
        </div>
        <div class="form-group">
            <label>Date de début</label>
            <input type="date" name="date_start" value="<?= $projects["date_start"]; ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Date de fin</label>
            <input type="date" name="date_end" value="<?= $projects["date_end"]; ?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Membres</label>
            <select name="member_ids[]" multiple class="form-control">
                <?php foreach ($members as $member) : ?>
                    <option value="<?= $member["id"]; ?>">
                        <?= $member["firstname"]; ?>
                        <?= $member["lastname"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="fa fa-check"></i>
            Modifier
        </button>
    </form>

<?php require_once __DIR__ . "/../../layout/footer.php"; ?>