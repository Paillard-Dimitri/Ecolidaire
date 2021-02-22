<?php
require_once __DIR__ . "/../../../model/database.php";

$members = getAllRows("member");

require_once __DIR__ . "/../../layout/header.php";
?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gestion des Membres</h1>
        <a href="create-form.php" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            Ajouter
        </a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="thead-light">
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>picture</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($members as $member) : ?>
            <tr>
                <td><?= $member["firstname"]; ?></td>
                <td><?= $member["lastname"]; ?></td>
                <td>
                    <img src="../../../images/<?= $member["picture"]; ?>" class="img-thumbnail">
                </td>
                <td class="actions">
                    <div class="d-flex justify-content-around">
                        <a href="update-form.php?id=<?= $member["id"]; ?>" class="btn btn-warning">
                            <i class="fa fa-edit"></i>
                            Modifier
                        </a>
                        <form method="post" action="delete-query.php">
                            <input type="hidden" name="id" value="<?= $member["id"]; ?>">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                                Supprimer
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php require_once __DIR__ . "/../../layout/footer.php"; ?>