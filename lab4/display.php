
<?php
echo '
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

require_once('connection/db_connection.php');

if ($db) {
    $query = 'SELECT * FROM `cafeteria`.`users`;';
    $stmt = $db->prepare($query);
    $result = $stmt->execute();
    if ($result) {
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}

?>
<table class="table table-hover table-dark">
  <thead>
    <tr>
    <th>#</th>
    <th>Name</th>
    <th>Email</th>
    <th>Password</th>
    <th>Exit</th>
    <th>Room No</th>
    <th>Image</th>
    <th>Edit</th>
    <th>Delete</th>

    </tr>
  </thead>
  <tbody>
  <?php foreach ($users as $user) { ?>
    <tr>
        <th><?= $user->id ?></th>
        <td><?= $user->name ?></td>
        <td><?= $user->email ?></td>
        <td><?= $user->password ?></td>
        <td><?= $user->exit ?></td>
        <td><?= $user->room ?></td>
        <td><img src="<?=$user->image ?>" width="50px" height="50px"></td>
        <td>
            <a href="edit.php?id=<?= $user->id ?>" class="btn btn-primary">Edit</a>

        </td>
        <td>
            <a href="delete.php?id=<?= $user->id ?>" class="btn btn-danger">Delete</a>
        </td>
    </tr>
    <?php } ?>
  </tbody>
</table>