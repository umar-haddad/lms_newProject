<?php 

//buat Query dimana ambil data dari majors kolom name terus as(dijadiin alias), instructors kolom name, dan moduls all
//si moduls Join ke table majors lewat majors.id di taro di moduls kolom id_major, dan Join juga si instructors 
//lewat instructors.id di taro pada moduls.id_instructor SEMUA AMBIL DARI ID TABLE MODULS
$query = mysqli_query($config, "SELECT majors.name as major_name, instructors.name as instructor_name, moduls.* 
FROM moduls 
LEFT JOIN majors ON majors.id = moduls.id_major 
LEFT JOIN instructors ON instructors.id = moduls.id_instructor 
ORDER BY moduls.id 
DESC");
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);


?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"> Data User</h5>
        <div class="mb-3" align="right">
          <a href="?page=tambah-modul" class="btn btn-primary">Add Modul</a>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Instruktur</th>
                <th>Jurusan</th>
                <th>Modul</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($rows as $key => $row): ?>
              <tr>
                <td><?php echo $key += 1; ?></td>
                <td><?php echo $row['instructor_name'] ?></td>
                <td><?php echo $row['major_name'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td>
                  <a href="?page=tambah-modul&edit=<?php echo $row ['id']?>" class="btn btn-primary">Edit</a>
                  <a onclick="return confirm('bener gak mau dihapus?')"
                    href="?page=tambah-modul&delete=<?php echo $row ['id']?>" class="btn btn-danger">Delete</a>
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