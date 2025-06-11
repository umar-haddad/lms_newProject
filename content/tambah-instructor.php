<!-- base On nya sama kaya tambah user -->

<?php 
if(isset($_POST['save'])) {
  // ada tidak parameter bernama edit kalo ada jalankan perintah edit/update, kalo tidak ada
  // tambah data baru /insert

  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $education = $_POST['education'];
  $phone = $_POST ['phone'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $address = $_POST['address'];
  $id_role = 4;
  $id_instructor = isset($_GET['edit']) ? $_GET['edit'] : '';

  $insertQ = mysqli_query($config, "INSERT INTO instructors (name, gender, education, phone, email, password, address, role) VALUES('$name', '$gender', '$education', '$phone', '$email', $password, '$address', '$id_role')");
  if ($insertQ) {
    header("location:?page=instructor&tambah=berhasil");
  }
}

  $header = isset($_GET['edit']) ? "save" : "edit";
  $id = isset($_GET['edit']) ? $_GET['edit'] : '';
  $query_Edit = mysqli_query($config, "SELECT * FROM instructors WHERE id='$id'");
  $rowEdit = mysqli_fetch_assoc($query_Edit);

  if(isset($_POST['edit'])) {
  // ada tidak parameter bernama edit kalo ada jalankan perintah edit/update

  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $education = $_POST['education'];
  $phone = $_POST ['phone'];
  $email = $_POST['email'];
  $password = isset($_POST['password']) ? sha1($_POST['password']) : $rowEdit['password'];
  $address = $_POST['address'];
    $id_role = 4;
  $id_instructor = isset($_GET['edit']) ? $_GET['edit'] : '';
      $queryUpdate = mysqli_query($config, "UPDATE instructors SET id_role='$id_role', name='$name', gender='$gender', education='$education', phone='$phone', email='$email', password='$password', address='$address' WHERE id='$id' ");
    if ($queryUpdate) {
        header("location:?page=instructor&update=berhasil");
    }
  }
  
  


 if(isset($_GET['delete'])){
   $id_instructor = isset($_GET['delete']) ? $_GET['delete'] : '' ;
   $queryDelete = mysqli_query($config, "DELETE FROM instructors WHERE id='$id_instructor'");
   if ($queryDelete) {
     header("location:?page=instructor&hapus=berhasil");
   } else {
     header("location:?page=instructor&hapus=gagal");
   }
 }

$gender = $rowEdit['gender'];
$gender == 1 ? 'Laki-laki' : 'Perempuan';
?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'edit' : 'save' ?> instructor</h5>
        <form action="" method="post">
          <div class="mb-3">
            <label for="">Fullname</label>
            <input type="text" class="form-control" name="name" placeholder="masukkan nama anda"
              value="<?= isset($rowEdit) && isset($rowEdit['name']) ? $rowEdit['name'] : '' ?>">
          </div>
          <div class="mb-3">
            <input type="radio" name="gender" value="1"
              <?= (isset($_GET['edit']) && $rowEdit['gender'] == '1') ? 'checked' : '' ?> required> Laki-Laki
            <input type="radio" name="gender" value="0"
              <?= (isset($_GET['edit']) && $rowEdit['gender'] == '0') ? 'checked' : '' ?> required> Perempuan
          </div>
          <div class="mb-3">
            <label for="">Education</label>
            <input type="text" class="form-control" name="education" placeholder="masukkan education anda"
              value="<?= isset($rowEdit) && isset($rowEdit['education']) ? $rowEdit['education'] : '' ?>">
          </div>
          <div class="mb-3">
            <label for="">Phone</label>
            <input type="number" class="form-control" name="phone" placeholder="masukkan phone anda"
              value="<?= isset($rowEdit) && isset($rowEdit['phone']) ? $rowEdit['phone'] : '' ?>">
          </div>
          <div class="mb-3">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" placeholder="masukkan email anda"
              value="<?= isset($rowEdit) && isset($rowEdit['email']) ? $rowEdit['email'] : '' ?>">
          </div>
          <div class="mb-3">
            <label for="">password</label>
            <input type="password" class="form-control" name="password" placeholder="masukkan password anda"
              value="<?= isset($rowEdit) && isset($rowEdit['password']) ? $rowEdit['password'] : '' ?>"
              <?php echo empty($id_user) ? "required" : '' ?>>
            <?php if (isset($_GET['edit'])) : ?>
            <small>
              )* eh antum mau ganti password, kamu bisa ganti sekarang
            </small>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="">address</label>
            <input type="text" class="form-control" name="address" placeholder="masukkan alamat anda"
              value="<?= isset($rowEdit) && isset($rowEdit['address']) ? $rowEdit['address'] : '' ?>">
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