<?php

if (isset($_SESSION['role'])) {
  $userrole = $_SESSION['role'];
} else {
  session_start();
  $userrole = $_SESSION['role'];
}
?>


<div class="menu">
  <div class="info-planning ">
    <ul class="mt6 pl0">
      <div class="img-planning flex justify-center mb3">
        <img
          class="mt3 flex justify-center"
          src="images/logomodifier.png"
          alt="" />

      </div>

      <div class="acceuil home mb3 flex font-sm pl1 ">
        <i class="fa-solid fa-house"></i>
        <a class="none" href="in_dashbord.php">
          <li class="ml1 ">Acceuil</li>
        </a>
      </div>


      <?php if ($userrole == 'client' || $userrole == 'admin') {   ?>
        <div class="profile mb3 flex font-sm pl1">
          <i class="fa-solid fa-user"></i>
          <a class="none" href="in_profile.php">
            <li class="ml1">Profile</li>
          </a>
        </div>
      <?php } ?>

      <?php if ($userrole == 'client' || $userrole == 'admin') {   ?>
        <div class="plannings mb3 flex font-sm pl1">
          <i class="fa-solid fa-calendar-days"></i>
          <a class="none" href="in_planing_command.php">
            <li class="ml1">Plannings commande</li>
          </a>
        </div>
      <?php } ?>


      <div class="historiquecommande mb3 flex font-sm pl1">
        <i class="fa-solid fa-clock-rotate-left"></i>
        <a class="none" href="in_historic_commande.php">
          <li class="ml1">Historique Commandes</li>
        </a>
      </div>


      <?php if ($userrole == 'admin') {   ?>
        <div class="listeclients mb3 flex font-sm pl1">
          <i class="fa-solid fa-list-check"></i>
          <a class="none" href="in_listClient.php ">
            <li class="ml1">Liste Clients</li>
          </a>
        </div>

        <div class="listeemployes mb3 flex font-sm pl1">
          <i class="fa-solid fa-list"></i>
          <a class="none" href="in_listEmployes.php ">
            <li class="ml1">Liste Employes</li>
          </a>
        </div>
      <?php } ?>

      <div class="mb3 flex font-sm pl1">
        <i class="plat fa-solid fa-burger"></i>
        <a href="in_plat.php">
          <li class="ml1">Plats</li>
        </a>
      </div>

    </ul>
  </div>
</div>