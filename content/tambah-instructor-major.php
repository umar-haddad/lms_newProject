<?php 
if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $id_instructorMajor = $_GET['id_instructor'];
  $queryDelete = mysqli_query($config, "DELETE FROM instructors_majors WHERE id='$id'");
  if ($queryDelete) {
  header("location:?page=tambah-instructor-major&id=" . $id_instructorMajor ."&hapus=berhasil");
  exit;
  } else {
  header("location:?page=tambah-instructor-major&id=" . $id_instructorMajor ."&hapus=gagal");
  exit;
  }
}

  $id = isset($_GET['edit']) ? $_GET['edit'] : '';
  $query_Edit = mysqli_query($config, "SELECT * FROM instructors WHERE id='$id'");
  $rowEdit = mysqli_fetch_assoc($query_Edit);
  $id = isset($_GET['id']) ? $_GET['id'] : '';


  $queryMajors = mysqli_query($config, "SELECT * FROM majors ORDER BY id DESC");
  $rowMajors = mysqli_fetch_all($queryMajors, MYSQLI_ASSOC);
  
  
  $queryInstructor = mysqli_query($config, "SELECT * FROM instructors WHERE id='$id'");
  $rowInstrutors = mysqli_fetch_assoc($queryInstructor);

  if(isset($_POST['id_major'])) {
  // ada tidak parameter bernama edit kalo ada jalankan perintah edit/update, kalo tidak ada
  // tambah data baru /insert
  $id_major = $_POST['id_major'];

  $insertQ = mysqli_query($config, "INSERT INTO instructors_majors (id_major, id_instructor) VALUES ('$id_major', '$id')");
    header("location:?page=tambah-instructor-major&id=" . $id . "&tambah=berhasil");
}


$queryInstructorMajor = mysqli_query($config, "SELECT majors.name, instructors_majors.id, id_instructor FROM instructors_majors LEFT JOIN majors ON majors.id = instructors_majors.id_major WHERE id_instructor = '$id' ORDER BY instructors_majors.id DESC");
$rowInstrutorMajors = mysqli_fetch_all($queryInstructorMajor, MYSQLI_ASSOC);
  print_r($rowInstrutorMajors); 

?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"> instructor-major : <?php echo $rowInstrutors['name'] ?>
        </h5>
        <!-- Button trigger modal -->
        <div align="right">
          <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add instructor Major
          </button>
        </div>

        <form action="" method="post">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Major Name</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($rowInstrutorMajors as $key => $rowInstrutorMajor) :?>
              <tr>
                <td><?php echo $key += 1 ?></td>
                <td><?php echo $rowInstrutorMajor['name']?></td>
                <td>
                  <a onclick="return confirm('yakin mau ngapus')"
                    href="?page=tambah-instructor-major&id_instructor=<?php echo $rowInstrutorMajor['id_instructor']?>&delete=<?php echo $rowInstrutorMajor['id']?>"
                    class="btn btn-danger" name="delete">Delete</a>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label for="">major Name</label>
            <select name="id_major" id="" class="form-control">
              <option value="">Select One</option>
              <?php foreach ($rowMajors as $rowMajor): ?>
              <option value="<?php echo $rowMajor['id'] ?>"><?php echo $rowMajor['name'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>