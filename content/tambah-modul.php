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
 
 $id_instructor = isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '';
 
 $queryInstructorMajors = mysqli_query($config, "SELECT majors.name, instructors_majors.*
 FROM instructors_majors 
 LEFT JOIN majors ON majors.id = instructors_majors.id_major 
 WHERE instructors_majors.id_instructor = '$id_instructor'");
 $rowInstructorMajor = mysqli_fetch_all($queryInstructorMajors, MYSQLI_ASSOC);

 
?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'edit' : 'save' ?> instructor</h5>

        <form action="" method="post">
          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <label for="" class="form-label">Instructor Name*</label>
                <input readonly type="text" class="form-control" value="<?php echo $_SESSION['NAME'] ?>">
                <input type="hidden" name="id_instructor" value="<?php echo $_SESSION['ID_USER']?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label for="" class="form-label">Major Name*</label>
                <select name="id_major" id="" class="form-control">
                  <option value="" name="action">
                    <?php echo !isset($_GET['action']) ? 'SELECT ONE 👀' : 'hidden' ?></option>
                  <?php foreach($rowInstructorMajor as $row) :?>
                  <option value="<?php echo $row['id_major'] ?>"><?php echo $row['name'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <input type="submit" class="btn btn-success" name="<?= isset($id) && $id != '' ? 'edit' : 'save'; ?>"
                  value=" <?= isset($id) && $id != '' ? 'edit' : 'save'; ?>">
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>