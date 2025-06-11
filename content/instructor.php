<!-- BASE ON NYA MAH SAMA KAYA SI DOKUMEN role.php -->

<?php 
$query = mysqli_query($config, "SELECT * FROM instructors  ORDER BY id DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"> Data instruktur</h5>
        <div class="mb-3" align="right">
          <a href="?page=tambah-instructor" class="btn btn-primary">Add Dosen</a>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Fullname</th>
                <th>Gender</th>
                <th>Education</th>
                <th>Phone</th>
                <th>email</th>
                <th>Address</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($rows as $key => $row): ?>
              <tr>
                <td><?php echo $key += 1; ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['gender'] == 1 ? "laki-laki" : "Perempuan"; ?></td>
                <td><?php echo $row['education'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['address'] ?></td>
                <td>
                  <a href="?page=tambah-instructor-major&id=<?php echo $row ['id']?>" class="btn btn-primary">Add
                    major</a>
                  <a href="?page=tambah-instructor&edit=<?php echo $row ['id']?>" class="btn btn-primary">Edit</a>
                  <a onclick="return confirm('bener gak mau dihapus?')"
                    href="?page=tambah-instructor&delete=<?php echo $row ['id']?>" class="btn btn-danger">Delete</a>
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