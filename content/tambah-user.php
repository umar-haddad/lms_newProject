<?php 
if(isset($_POST['save'])) {
  // buat sebuah tambah user diambil dari data table users
  // tambah data baru /insert

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password']; 
  $id_user = isset($_GET['edit']) ? $_GET['edit'] : '';

  $insertQ = mysqli_query($config, "INSERT INTO users (name, email, password) VALUES('$name', '$email', '$password')");
  if ($insertQ) {
    header("location:?page=user&tambah=berhasil");
  }
}

  $header = isset($_GET['edit']) ? "save" : "edit"; // ambil name edit ada gak kalo ada jadi edit kalo gak ada jadi save
  $id = isset($_GET['edit']) ? $_GET['edit'] : ''; //buat parameter id ini bisa di edit 
  $query_Edit = mysqli_query($config, "SELECT * FROM users WHERE id='$id'"); //ambil semua data dari users.id
  $rowEdit = mysqli_fetch_assoc($query_Edit);

  if(isset($_POST['edit'])) {
  // ada tidak parameter bernama edit kalo ada jalankan perintah edit/update

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = isset($_POST['password']) ? sha1($_POST['password']) : $rowEdit['password'];
  $id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
      $queryUpdate = mysqli_query($config, "UPDATE users SET name='$name', email='$email', password='$password' WHERE id='$id' ");
    if ($queryUpdate) {
        header("location:?page=user&update=berhasil");
    }
  }
  
  


 if(isset($_GET['delete'])){ // name delete ada isinya gak kalo ada hapus dari id nya 
   $id_user = isset($_GET['delete']) ? $_GET['delete'] : '' ;
   $queryDelete = mysqli_query($config, "UPDATE users SET deleted_at = 1 WHERE id='$id_user'");
   if ($queryDelete) {
     header("location:?page=user&hapus=berhasil");
   } else {
     header("location:?page=user&hapus=gagal");
   }
 }

?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'edit' : 'Add' ?> User</h5>
        <form action="" method="post">
          <div class="mb-3">
            <label for="">Fullname</label>
            <input type="text" class="form-control" name="name" placeholder="masukkan nama anda"
              value="<?= isset($rowEdit) && isset($rowEdit['name']) ? $rowEdit['name'] : '' ?>">
          </div>
          <div class="mb-3">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" placeholder="masukkan email anda"
              value="<?= isset($rowEdit) && isset($rowEdit['email']) ? $rowEdit['email'] : '' ?>">
          </div>
          <div class="mb-3">
            <label for="">password</label>
            <input type="password" class="form-control" name="password" placeholder="masukkan password anda" value=""
              <?php echo empty($id_user) ? "required" : '' ?>>
            <?php if (isset($_GET['edit'])) : ?>
            <small>
              )* eh antum mau ganti password, kamu bisa ganti sekarang
            </small>
            <?php endif; ?>
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