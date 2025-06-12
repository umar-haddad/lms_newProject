<!-- base On nya sama kaya tambah user -->

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

 if(isset($_GET['add-role-menu'])) {
  $id_role = $_GET['add-role-menu'];

  $edit = [];
  $rowEditRoleMenu = [];
  $editRoleMenu = mysqli_query($config, "SELECT * FROM menu_roles WHERE id_roles='$id_role'");
  // $rowEditRoleMenu = mysqli_fetch_all($editRoleMenu, MYSQLI_ASSOC);
  $rowEditRoleMenu =[];
  $menus = mysqli_query($config, "SELECT * FROM menus ORDER BY parent_id, urutan");
  
  while($editMenu = mysqli_fetch_assoc($editRoleMenu)) {
    $rowEditRoleMenu[] = $editMenu['id_menu'] ;
 }

  $rowMenu = [];
  while($m = mysqli_fetch_assoc($menus)) {
    $rowMenu[] = $m;
  }
  
  // echo "<pre>";
  // print_r($rowMenu); die;
 }


 
 if(isset($_POST['tambah'])) {
  $id_role = $_GET['add-role-menu'];
  $id_menus = $_POST['id_menus'] ?? [];

  mysqli_query($config, "DELETE FROM menu_roles WHERE id_roles='$id_role'");
  foreach($id_menus as $rm) {
    $id_menu = $rm;
    mysqli_query($config, "INSERT INTO menu_roles (id_roles, id_menu) VALUES ('$id_role', '$id_menu')");
  }
  header("location:?page=tambah-role&add-role-menu=" . $id_role . "&tambah=berhasil");

 }

?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'edit' : 'Add' ?> Role</h5>
        <?php if(isset($_GET['add-role-menu'])) : ?>
        <form action="" method="post">
          <div class="mb-3">
            <ul>
              <?php foreach ($rowMenu as $mainMenu) : ?>
              <?php if($mainMenu['parent_id'] == 0 or $mainMenu['parent_id'] == '') :?>
              <li>
                <label for="">
                  <input <?php echo in_array($mainMenu['id'], $rowEditRoleMenu) ? 'checked' : '' ?> type="checkbox"
                    name="id_menus[]" id="menu" value="<?php echo $mainMenu['id'] ?>">
                  <?php echo $mainMenu['name'] ?>
                </label>
                <ul>
                  <?php foreach ($rowMenu as $subMenu) : ?>
                  <?php if($subMenu['parent_id'] == $mainMenu['id'])  : ?>
                  <li>
                    <label for="">
                      <input <?php echo in_array($subMenu['id'], $rowEditRoleMenu) ? 'checked' : '' ?> type="checkbox"
                        name="id_menus[]" id="subMenu" value="<?php echo $subMenu['id'] ?>">
                      <?php echo $subMenu['name'] ?>
                    </label>
                  </li>
                  <?php endif ?>
                  <?php endforeach ?>
                </ul>
              </li>
              <?php endif ;?>
              <?php endforeach ;?>
            </ul>
          </div>
          <div class="mb-3" align="right">
            <button class="btn btn-primary " type="submit" name="tambah">
              Insert
            </button>
          </div>
        </form>
        <?php elseif (isset($_GET['edit'])) : ?>
        <form action="" method="post">
          <div class="mb-3">
            <label for="">Role</label>
            <input type="text" class="form-control" name="name" placeholder="masukkan Role anda"
              value="<?= isset($rowEdit) && isset($rowEdit['name']) ? $rowEdit['name'] : '' ?>">
          </div>
          <div class=" mb-3">
            <input type="submit" class="btn btn-success" name="<?= isset($id) && $id != '' ? 'edit' : 'save'; ?>"
              value=" <?= isset($id) && $id != '' ? 'edit' : 'save'; ?>">
          </div>
        </form>
        <?php else: ?>
        <form action="" method="post">
          <div class="mb-3">
            <label for="">Role</label>
            <input type="text" class="form-control" name="name" placeholder="masukkan Role anda"
              value="<?= isset($rowEdit) && isset($rowEdit['name']) ? $rowEdit['name'] : '' ?>">
          </div>
          <div class=" mb-3">
            <input type="submit" class="btn btn-success" name="<?= isset($id) && $id != '' ? 'edit' : 'save'; ?>"
              value=" <?= isset($id) && $id != '' ? 'edit' : 'save'; ?>">
          </div>
        </form>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>

<script>
function checkRole() {
  let menu = document.getElementById('menu');
  let subMenu = document.getElementById('subMenu')

  for (let i = 0; i < subMenu; i++) {

  }

}
</script>