<?php
if (isset($_SESSION['role'])) {
  $userrole = $_SESSION['role'];
  $user_id = $_SESSION['user_id'];
} else {
  session_start();
  $userrole = $_SESSION['role'];
}

function isCurrentPage($page) {
  $current_page = basename($_SERVER['PHP_SELF']);
  return $current_page === $page;
}
?>

<div class="d-flex flex-column flex-shrink-0 p-3 bg-dark" style="width: 280px; min-height: 100vh;">
  <div class="text-center mb-4">
    <img src="images/logomodifier.png" alt="" class="img-fluid" style="width: 120px;">
  </div>
  
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item mb-2">
      <a href="in_dashbord.php" class="nav-link <?php echo isCurrentPage('in_dashbord.php') ? 'active' : 'text-white-50'; ?>">
        <i class="fa-solid fa-house me-2"></i>
        Acceuil
      </a>
    </li>

    <?php if ($userrole == 'client' || $userrole == 'admin') { ?>
    <li class="nav-item mb-2">
      <form action="/project-cantine-php/in_profile.php" method="post" class="nav-link <?php echo isCurrentPage('in_profile.php') ? 'active' : 'text-white-50'; ?>" style="border: none; background: none; cursor: pointer;">
        <i class="fa-solid fa-user me-2"></i>
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <button type="submit" name="action" value="openUserProfile" class="border-0 p-0 m-0" style="background: none;">
          Profile
        </button>
      </form>
    </li>

    <li class="nav-item mb-2">
      <a href="in_planing_command.php" class="nav-link <?php echo isCurrentPage('in_planing_command.php') ? 'active' : 'text-white-50'; ?>">
        <i class="fa-solid fa-calendar-days me-2"></i>
        Plannings commande
      </a>
    </li>
    <?php } ?>

    <li class="nav-item mb-2">
      <a href="in_historic_commande.php" class="nav-link <?php echo isCurrentPage('in_historic_commande.php') ? 'active' : 'text-white-50'; ?>">
        <i class="fa-solid fa-clock-rotate-left me-2"></i>
        Historique Commandes
      </a>
    </li>

    <?php if ($userrole == 'admin') { ?>
    <li class="nav-item mb-2">
      <a href="in_listClient.php" class="nav-link <?php echo isCurrentPage('in_listClient.php') ? 'active' : 'text-white-50'; ?>">
        <i class="fa-solid fa-list-check me-2"></i>
        Liste Clients
      </a>
    </li>

    <li class="nav-item mb-2">
      <a href="in_listEmployes.php" class="nav-link <?php echo isCurrentPage('in_listEmployes.php') ? 'active' : 'text-white-50'; ?>">
        <i class="fa-solid fa-list me-2"></i>
        Liste Employes
      </a>
    </li>
    <?php } ?>

    <li class="nav-item mb-2">
      <a href="in_plat.php" class="nav-link <?php echo isCurrentPage('in_plat.php') ? 'active' : 'text-white-50'; ?>">
        <i class="fa-solid fa-burger me-2"></i>
        Plats
      </a>
    </li>

    <li class="nav-item mb-2">
      <a href="logout.php" class="nav-link text-white-50">
        <i class="fa-solid fa-right-from-bracket me-2"></i>
        Déconnexion
      </a>
    </li>
  </ul>
</div>

<style>
.nav-link {
  border-radius: 8px;
  padding: 10px 15px;
  transition: all 0.3s ease;
}

.nav-link:hover {
  background-color: rgba(255, 255, 255, 0.1);
  transform: translateX(5px);
}

.nav-link.active {
  background-color: #0d6efd !important;
  color: white !important;
}

.nav-link button {
  color: inherit;
}
</style>