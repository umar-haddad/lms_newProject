<?php 
$id_user = isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : "" ;
$id_role = isset($_SESSION['ID_ROLE']) ? $_SESSION['ID_ROLE'] : "" ;

//
$rowStudents = mysqli_fetch_assoc(mysqli_query($config, "SELECT * FROM students WHERE id='$id_user'"));
$id_major =$rowStudents['id'];

if($id_role == 2) {
  $where = "WHERE moduls.id_major='$id_major'";
} elseif ($id_role == 1) {
  $where = "WHERE moduls.id_major='$id_user'";
}
$query = mysqli_query($config, "SELECT majors.name as major_name, instructors.name as instructor_name, moduls.* 
FROM moduls 
LEFT JOIN majors ON majors.id = moduls.id_major 
LEFT JOIN instructors ON instructors.id = moduls.id_instructor 
$where
ORDER BY moduls.id 
DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);


?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"> Data Modul</h5>
        <?php if($_SESSION['ID_ROLE'] == 1) : ?>
        <div class="mb-3" align="right">
          <a href="?page=tambah-modul" class="btn btn-primary">Add Modul</a>
        </div>
        <?php endif ?>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Modul</th>
                <th>Nama Instruktur</th>
                <th>Jurusan</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($rows as $key => $row): ?>
              <tr>
                <td><?php echo $key += 1; ?></td>
                <td><a href="?page=tambah-modul&detail=<?php echo $row['id'] ?>>"><?php echo $row['name'] ?></a></td>
                <td><?php echo $row['instructor_name'] ?></td>
                <td><?php echo $row['major_name'] ?></td>
                <td>
                  <a onclick="return confirm('bener gak mau dihapus?')"
                    href="?page=tambah-modul&delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a>
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