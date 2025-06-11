<?php 
$query = mysqli_query($config, "SELECT * FROM menus ORDER BY id DESC"); //ambil data dari table menus dari colom id
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<div class="row">
  <div class="col-12">
    <div class="card data-table">
      <div class="card-body">
        <h5 class="card-title"> Data menu</h5>
        <div class="mb-3" align="right">
          <a href="?page=tambah-menu" class="btn btn-primary">Add menu</a>
        </div>
        <div class="table-responsive">
          <table class="table table-hover table-bordered datatable" id="insTable">
            <thead class="text-center table-primary pt-2">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Parent</th>
                <th scope="col">Icon</th>
                <th scope="col">Url</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($rows as $key => $row): ?>
              <tr>
                <td><?php echo $key += 1; ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['parent_id'] ?></td>
                <td><?php echo $row['icon'] ?></td>
                <td><?php echo $row['url'] ?></td>
                <td>
                  <a href="?page=tambah-menu&edit=<?php echo $row ['id']?>" class="btn btn-primary">Edit</a>
                  <a onclick="return confirm('bener gak mau dihapus?')"
                    href="?page=tambah-menu&delete=<?php echo $row ['id']?>" class="btn btn-danger">Delete</a>
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