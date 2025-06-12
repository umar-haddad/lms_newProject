<?php 
  $id_roles = isset($_SESSION['ID_ROLE']) ? $_SESSION['ID_ROLE'] : '';
  $queryMainMenu = mysqli_query($config, "SELECT DISTINCT menus.* FROM menus 
                                          JOIN menu_roles ON menus.id = menu_roles.id_menu
                                          JOIN roles ON roles.id = menu_roles.id_roles
                                          WHERE menu_roles.id_roles = '$id_roles'  parent_id=''");
  $rowMainMenu = mysqli_fetch_all($queryMainMenu, MYSQLI_ASSOC);
?>

<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <?php foreach ($rowMainMenu as $mainMenu) : ?>

    <?php 
          $id_menu = $mainMenu['id'];
          $querySubMenu = mysqli_query($config, "SELECT DISTINCT menus.* FROM menus 
          JOIN menu_roles ON menus.id = menu_roles.id_menu
          JOIN roles ON roles.id = menu_roles.id_roles 
          WHERE menu_roles.id_roles ='$id_roles' AND parent_id ='$id_menu' ORDER BY urutan ASC");


        ?>
    <?php if(mysqli_num_rows($querySubMenu) > 0): ?>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#menu-<?php echo $mainMenu['id'] ?>" data-bs-toggle="collapse"
        href="#">
        <i class="<?php echo $mainMenu['icon'] ?>"></i><span><?php echo $mainMenu['name'] ?></span><i
          class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="menu-<?php echo $mainMenu['id']?>" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <?php while ($rowSubMenu = mysqli_fetch_assoc($querySubMenu)): ?>
        <li>
          <a href="?page=<?php echo $rowSubMenu['url'] ?> ">
            <i class="<?php echo $rowSubMenu['icon'] ?>"></i><span><?php echo $rowSubMenu['name'] ?></span>
          </a>
        </li>
        <?php endwhile; ?>
      </ul>
    </li>
    <?php elseif(!empty($mainMenu['url'])) : ?>
    <li class="nav-item">
      <a class="nav-link collapsed" href="<?php echo $mainMenu['url'] ?>">
        <i class="<?php echo $mainMenu['icon'] ?>"></i>
        <span><?php echo $mainMenu['name'] ?></span>
      </a>
    </li>
    <!--End Dashboard Nav -->
    <?php endif; ?>
    <?php endforeach; ?>

    <!-- <li class=" nav-heading">Pages
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="?page=moduls">
        <i class="bi bi-book"></i>
        <span>Module</span>
      </a>
    </li> -->
    <!-- End Profile Page Nav -->
  </ul>

</aside>