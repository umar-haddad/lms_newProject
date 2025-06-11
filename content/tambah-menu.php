<!-- base On nya sama kaya tambah user -->

<?php 

// $id = isset($_GET['edit']) ? $_GET['edit'] : '';
// $query_Edit = mysqli_query($config, "SELECT * FROM menus WHERE id='$id'");
// $rowEdit = mysqli_fetch_assoc($query_Edit);
// $id = isset($_GET['id']) ? $_GET['id'] : '';

$editMenu = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM menus WHERE id='$editMenu'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if(isset($_POST['name'])) {
  $name = $_POST['name'];
  $icon = htmlspecialchars($_POST['icon']);
  $urutan = $_POST['urutan'];
  $url = $_POST['url'];
  $parentId = $_POST['parent_id'];

   if(isset($_GET['edit'])) {
     $updateQ = mysqli_query($config, "UPDATE menus SET name='$name', icon='$icon', urutan=$urutan, url='$url', parent_id='$parentId' WHERE id=$editMenu");
      header("location:?page=menu&id=" . $editMenu . "&update=berhasil");
    } else {     
     $insertQ = mysqli_query($config, "INSERT INTO menus (name, icon, urutan, url, parent_id) VALUES ('$name', '$icon', '$urutan', '$url', '$parentId')");
      header("location:?page=menu&id=" . $editMenu . "&tambah=berhasil");
    }
}


  

 if(isset($_GET['delete'])){
   $id_menu = isset($_GET['delete']) ? $_GET['delete'] : '' ;
   $queryDelete = mysqli_query($config, "DELETE FROM menus WHERE id='$id_menu'");
   if ($queryDelete) {
     header("location:?page=menu&hapus=berhasil");
   } else {
     header("location:?page=menu&hapus=gagal");
   }
 }

$queryParentId = mysqli_query($config, "SELECT * FROM menus WHERE parent_id IS NULL OR parent_id =''");
$rowParentId = mysqli_fetch_all($queryParentId, MYSQLI_ASSOC);

?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'edit' : 'save' ?> menu</h5>
        <form action="" method="post">
          <div class="mb-3">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" placeholder="masukkan menu anda"
              value="<?= isset($rowEdit) && isset($rowEdit['name']) ? $rowEdit['name'] : '' ?>">
          </div>
          <div class="mb-3">
            <label for="">Parent Id</label>
            <select name="parent_id" id="" class="form-control">
              <option value="">Select One</option>
              <?php foreach ($rowParentId as $parentId): ?>
              <option value="<?php echo $parentId['id'] ?>"><?php echo $parentId['name'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="">Icon *</label>
            <input type="text" class="form-control" name="icon" placeholder="masukkan Icon anda"
              value="<?= isset($rowEdit) && isset($rowEdit['icon']) ? $rowEdit['icon'] : '' ?>" required>
          </div>
          <div class="mb-3">
            <label for="">Url</label>
            <input type="text" class="form-control" name="url" placeholder="masukkan Url anda"
              value="<?= isset($rowEdit) && isset($rowEdit['url']) ? $rowEdit['url'] : '' ?>">
          </div>
          <div class="mb-3">
            <label for="">Order</label>
            <input type="number" class="form-control" name="urutan" placeholder="masukkan Urutan anda"
              value="<?= isset($rowEdit) && isset($rowEdit['urutan']) ? $rowEdit['urutan'] : '' ?>">
          </div>
          <div class=" mb-3">
            <input type="submit" class="btn btn-success" name="<?= isset($editMenu) ? 'edit' : 'save'; ?>"
              value=" <?= isset($editMenu) ? 'edit' : 'save'; ?>">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>