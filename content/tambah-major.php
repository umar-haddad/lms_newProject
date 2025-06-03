<?php 
if(isset($_POST['save'])) {
  // ada tidak parameter bernama edit kalo ada jalankan perintah edit/update, kalo tidak ada
  // tambah data baru /insert

  $name = $_POST['name'];
  $id_major = isset($_GET['edit']) ? $_GET['edit'] : '';

  $insertQ = mysqli_query($config, "INSERT INTO majors (name) VALUES('$name')");
  if ($insertQ) {
    header("location:?page=major&tambah=berhasil");
  }
}

  $header = isset($_GET['edit']) ? "save" : "edit";
  $id = isset($_GET['edit']) ? $_GET['edit'] : '';
  $query_Edit = mysqli_query($config, "SELECT * FROM majors WHERE id='$id'");
  $rowEdit = mysqli_fetch_assoc($query_Edit);

  if(isset($_POST['edit'])) {
  // ada tidak parameter bernama edit kalo ada jalankan perintah edit/update

  $name = $_POST['name'];
  $id_major = isset($_GET['edit']) ? $_GET['edit'] : '';
      $queryUpdate = mysqli_query($config, "UPDATE majors SET name='$name' WHERE id='$id' ");
    if ($queryUpdate) {
        header("location:?page=major&update=berhasil");
    }
  }
  

 if(isset($_GET['delete'])){
   $id_major = isset($_GET['delete']) ? $_GET['delete'] : '' ;
   $queryDelete = mysqli_query($config, "DELETE FROM majors WHERE id='$id_major'");
   if ($queryDelete) {
     header("location:?page=major&hapus=berhasil");
   } else {
     header("location:?page=major&hapus=gagal");
   }
 }

?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Add User</h5>
        <form action="" method="post">
          <div class="mb-3">
            <label for="">Jurusan</label>
            <input type="text" class="form-control" name="name" placeholder="masukkan jurusan anda"
              value="<?= isset($rowEdit) && isset($rowEdit['name']) ? $rowEdit['name'] : '' ?>">
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