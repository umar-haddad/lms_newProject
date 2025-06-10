<?php 
if(isset($_POST['save'])) {
  // ada tidak parameter bernama edit kalo ada jalankan perintah edit/update, kalo tidak ada
  // tambah data baru /insert
  
  $id_instructor =  $_POST['id_instructor'];
  $id_major	= $_POST['id_major'];
  $name = $_POST['name'];

 $insertQ = mysqli_query($config, "INSERT INTO moduls (id_instructor, id_major, name) VALUES('$id_instructor', '$id_major', '$name')");
 
 if ($insertQ) {
   $id_modul = mysqli_insert_id($config);

  //  print_r($_FILES); die;
   // save File ==>
   foreach($_FILES['file']['name'] as $index => $file) {
     if ($_FILES['file']['error'][$index] == 0) {
       $name = basename($_FILES['file']['name'][$index]);
       $fileName = uniqid() . "-" . $name;
       $path = "uploads/";
       $targetPath = $path . $fileName;

       if (move_uploaded_file($_FILES['file']['tmp_name'][$index], $targetPath)) {
         $insertModulDetail = mysqli_query($config, "INSERT INTO module_details ( id_modul, file ) VALUES ('$id_modul', '$fileName')");
       }
     }
   }
   header("location:?page=moduls&tambah=berhasil");
 }
}

if(isset($_GET['delete'])){
   $id_modul = isset($_GET['delete']) ? $_GET['delete'] : '' ;

   // query buat delete
   $queryModulsDetails = mysqli_query($config, "SELECT file FROM module_details WHERE id_modul='$id_modul'");
   $rowModulsDelete = mysqli_fetch_assoc($queryModulsDetails);
   unlink("uploads/" . $rowModulsDelete['file']) ;

   $queryDelete = mysqli_query($config, "DELETE FROM module_details WHERE id_modul='$id_modul'");
   $queryDelete = mysqli_query($config, "DELETE FROM moduls WHERE id='$id_modul'");
   if ($queryDelete) {
     header("location:?page=moduls&hapus=berhasil");
   } else {
     header("location:?page=moduls&hapus=gagal");
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
  

 


 
 $id_instructor = isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '';
 
 $queryInstructorMajors = mysqli_query($config, "SELECT majors.name, instructors_majors.*
 FROM instructors_majors 
 LEFT JOIN majors ON majors.id = instructors_majors.id_major 
 WHERE instructors_majors.id_instructor = '$id_instructor'");
 $rowInstructorMajor = mysqli_fetch_all($queryInstructorMajors, MYSQLI_ASSOC);

 $id_modul = isset($_GET['detail']) ? $_GET['detail'] : '';
 $queryModul = mysqli_query($config, "SELECT majors.name as major_name, instructors.name as instructor_name, moduls.* 
 FROM moduls 
 LEFT JOIN majors ON majors.id = moduls.id_major 
 LEFT JOIN instructors ON instructors.id = moduls.id_instructor 
 WHERE moduls.id = '$id_modul'");
 $rowModul = mysqli_fetch_assoc($queryModul);

// query ke table modul
 $queryDetailModul = mysqli_query($config, "SELECT * FROM module_details WHERE id_modul = '$id_modul'");
 $rowDetailModul = mysqli_fetch_all($queryDetailModul, MYSQLI_ASSOC);

 if(isset($_GET['download'])) {
  $file = $_GET['download'];
  $filepath = "uploads/" . $file;
  if(file_exists($filepath)) {
    header("Content-Description: File Transfer");
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=" . basename($filepath) . "");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");
    header("Expires:0");
    header("Cache-Control:-must-revalidate");
    header("pragma:public");
    header("Content-Length:" . filesize($filepath) . "");
    ob_clean();
    flush();
    readfile($filepath);

  }

 }
 
?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo isset($_GET['detail']) ? 'detail' : 'save' ?> instructor</h5>

        <?php if (isset($_GET['detail'])): ?>
        <table class="table table-stripped">
          <tr>
            <th>Modul name</th>
            <th>:</th>
            <td><?php echo $rowModul['name'] ?></td>
            <th>Major</th>
            <th>:</th>
            <td><?php echo $rowModul['major_name'] ?></td>
          </tr>
          <tr>
            <th>Instructor</th>
            <th>:</th>
            <td><?php echo $rowModul['instructor_name'] ?></td>
          </tr>
        </table>
        <br>
        <br>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>number</th>
              <th>File</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($rowDetailModul as $index => $rowModul) : ?>
            <tr>
              <td><?php echo $index += 1; ?></td>
              <td><a href="?page=tambah-modul&download=<?php echo urlencode($rowModul['file'])?>" target="_blank">
                  <?php echo $rowModul['file'] ?> <i class="bi bi-download"></i>
                </a></td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <?php else: ?>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <label for="" class="form-label">Instructor Name *</label>
                <input readonly type="text" class="form-control" value="<?php echo $_SESSION['NAME'] ?>">
                <input type="hidden" name="id_instructor" value="<?php echo $_SESSION['ID_USER']?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label for="" class="form-label">Major Name *</label>
                <select name="id_major" id="" class="form-control" required>
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
                <label for="" class="form-label">Judul Modul *</label>
                <input type="text" name="name" value="name" class="form-control" placeholder="masukkan modul" required>
              </div>
            </div>
            <div align="right" class="mb-3">
              <button type="button" class="btn btn-primary" id="addRow"> Add Row</button>
            </div>

            <table class="table" id="myTable">
              <thead>
                <tr>
                  <th>file</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>

            <div class="mb-3">
              <input type="submit" class="btn btn-success" name="<?= isset($id) && $id != '' ? 'edit' : 'save'; ?>"
                value=" <?= isset($id) && $id != '' ? 'edit' : 'save'; ?>">
            </div>
          </div>
        </form>
        <?php endif ?>

      </div>
    </div>
  </div>
</div>

<script>
let row = document.getElementById('addRow');
let tbody = document.querySelector('#myTable tbody');
row.addEventListener("click", function() {
  const tr = document.createElement('tr');
  tr.innerHTML = `
  <td><input type='file' name='file[]'></td>
  <td><button class="btn btn-danger">delete</button></td>
  `;
  console.log(tr);
  tbody.appendChild(tr);
});
</script>