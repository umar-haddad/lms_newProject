<?php 
$query = mysqli_query($config, "SELECT * FROM users WHERE deleted_at = 1 ORDER BY id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

if(isset($_GET['restore'])) {
  $restore = $_GET['restore'];
  $queryRestore = mysqli_query($config, "UPDATE users SET deleted_at = 0 WHERE id=$restore");
  if ($queryRestore) {
    header("location: ?page=user&restore=berhasil");
  } 
}

if(isset($_GET['delete'])) {
  $delete = $_GET['delete'];
  $queryRestore = mysqli_query($config, "DELETE FROM users WHERE id=$delete");
  if ($queryRestore) {
    header("location: ?page=user&hapus=berhasil");
  } 
}
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"> Data User</h5>
        <div class="mb-3 d-flex justify-content-between">
          <a href="?page=user" class="btn btn-secondary">Back</a>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Fullname</th>
                <th>email</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($rows as $key => $row): ?>
              <tr>
                <td><?php echo $key += 1; ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td>
                  <a href="?page=restore-user&restore=<?php echo $row ['id']?>" class="btn btn-success">Edit</a>
                  <a onclick="return confirm('bener gak mau dihapus?')"
                    href="?page=restore-user&delete=<?php echo $row ['id']?>" class="btn btn-danger">Delete</a>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>