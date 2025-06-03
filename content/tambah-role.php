<?php 
if(isset($_POST['save'])) {
  // ada tidak parameter bernama edit kalo ada jalankan perintah edit/update, kalo tidak ada
  // tambah data baru /insert

  $name = $_POST['name'];
  $id_role = isset($_GET['edit']) ? $_GET['edit'] : '';

  $insertQ = mysqli_query($config, "INSERT INTO roles (name) VALUES('$name')");
  if ($insertQ) {
    header("location:?page=role&tambah=berhasil");
  }
}

  $header = isset($_GET['edit']) ? "save" : "edit";
  $id = isset($_GET['edit']) ? $_GET['edit'] : '';
  $query_Edit = mysqli_query($config, "SELECT * FROM roles WHERE id='$id'");
  $rowEdit = mysqli_fetch_assoc($query_Edit);

  if(isset($_POST['edit'])) {
  // ada tidak parameter bernama edit kalo ada jalankan perintah edit/update

  $name = $_POST['name'];
  $id_role = isset($_GET['edit']) ? $_GET['edit'] : '';
      $queryUpdate = mysqli_query($config, "UPDATE roles SET name='$name' WHERE id='$id' ");
    if ($queryUpdate) {
        header("location:?page=role&update=berhasil");
    }
  }
  

 if(isset($_GET['delete'])){
   $id_role = isset($_GET['delete']) ? $_GET['delete'] : '' ;
   $queryDelete = mysqli_query($config, "DELETE FROM roles WHERE id='$id_role'");
   if ($queryDelete) {
     header("location:?page=role&hapus=berhasil");
   } else {
     header("location:?page=role&hapus=gagal");
   }
 }

$roles = ['Instruktur', 'Mahasiswa', 'Admin'];
$currentRole = isset($rowEdit['name']) ? $rowEdit['name'] : '';
?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Add User</h5>
        <form action="" method="post">
          <div class="mb-4">
            <select class="form-select" name="name" aria-label="Default select example">
                <option disabled <?= $currentRole == '' ? 'selected' : '' ?>>Pilih Role Anda</option>
                <?php foreach ($roles as $role): ?>
                     <option value="<?= $role ?>" <?= $currentRole == $role ? 'selected' : '' ?>><?= $role ?></option>
                <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <input type="submit" class="btn btn-success" name="<?= isset($id) && $id != '' ? 'edit' : 'save'; ?>"
              value=" <?= isset($id) && $id != '' ? 'edit' : 'save'; ?>">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>