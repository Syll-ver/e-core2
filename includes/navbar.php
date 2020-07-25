<?php

include_once("includeThis/adFunction.php");
$user = htmlspecialchars($_SESSION["username"]);

?>

<style>
  .badge-light{
   position: relative;
   top: -9px;
   left: -17px;
}
</style>

<header class="navbar navbar-expand flex-column flex-md-row bd-navbar" style="border-radius: 0; font-size: 13px;">
  <a class="navbar-brand mr-0 mr-md-2" href="index.php" aria-label="Bootstrap" style="padding-top: 15px;"><h3>MSU-General Santos e-CORE</h3></a>

  <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
    <li class="nav-item dropdown">
      <a class="nav-item nav-link mr-md-2" href="" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><p>Active AY:
        <?php $yearAY = activeay();
        if($yearAY['status'] == true){
          echo $yearAY['acadYear'];
        }
       ?></p>
      </a>
    </li>
<!--     <li class="nav-item dropdown">
      <a class="nav-item nav-link mr-md-2" href="#" id="notifdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-bell">
          <?php
          //$notifCount = notifCount($user);
          ?>
        </span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifdropdown">
        <?php
        //$notification = notification($user);
        ?>
      </div>
    </li> -->
    <li class="nav-item dropdown">
      <a class="nav-item nav-link mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-user"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
        <a class="dropdown-item active" href="myAccount.php">My Account</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="logout.php">Logout</a>
      </div>
    </li>
  </ul>
</header>



<!-- Add Page -->

<div class="modal" id="notifMe" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    </div>
  </div>
</div>