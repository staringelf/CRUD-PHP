<?php
  if( isset($_SESSION['success']) ) {
    echo '<p class="success">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
  }

  if( isset($_SESSION['error']) ) {
    echo '<p class="error">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
  }
?>