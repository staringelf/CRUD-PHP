<?php
  require_once "pdo.php";
  require_once "header.php";
  session_start();
  //After Confirm Delete
  if( isset($_POST['user_id']) ){
    $stmt = $pdo->prepare("DELETE FROM Users WHERE user_id = :id");
    $stmt->execute(array(
      ':id' => $_POST['user_id']
    ));
    $_SESSION['success'] = 'Account Deleted!';
    header('Location: index.php');
    return; //to stop falling through
  }

  $stmt = $pdo->prepare("SELECT name, user_id FROM Users WHERE user_id = :id");
  $stmt->execute(array(
    ':id' => $_GET['user_id']
  ));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if(!$row){
    $_SESSION['error'] = 'Error 420: Incorrect user_id';
    header('Location: index.php');
    return;
  }
?>
<h2>Confirm Deleting <?= htmlentities($row['name']) ?></h2>
<form method="POST">
  <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
  <input type="submit" value="Confirm Delete" name="delete">
</form>
<p>OR</p>
<p><a href="index.php">See Index</a></p>