<?php 
$query = mysqli_query($config, "SELECT * FROM users  ORDER BY id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"> Data User</h5>
        <div class="mb-3" align="right">
          <a href="?page=tambah-user" class="btn btn-primary">Add User</a>
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
                  <a href="?page=tambah-user&edit=<?php echo $row ['id']?>" class="btn btn-primary">Edit</a>
                  <a onclick="return confirm('bener gak mau dihapus?')"
                    href="?page=tambah-user&delete=<?php echo $row ['id']?>" class="btn btn-danger">Delete</a>
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