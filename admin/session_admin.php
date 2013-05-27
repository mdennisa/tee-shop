<?php 
$usergroup = (empty($_SESSION['usergroup'])) ? false : $_SESSION['usergroup'];
if($usergroup != 'admin') {
  header('location:'.base_url.'index.php?log=access-denied');
}
