<?php
  require_once "pdo.php";
  require_once "header.php";
  session_start();
  if( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) ){
    $sql = "INSERT INTO Users (name, email, password) 
              VALUES (:name, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':name' => $_POST['name'],
      ':email' => $_POST['email'],
      ':password' => $_POST['password']
    ));
    $_SESSION['success'] =  'Successfully added!';
    header('Location: index.php');
    return;
  }
?>

<body>
  <h2> Register </h2>
  <p><a href="index.php">See Index</a></p>
  <?php 
    require_once "flash.php";
  ?>
  <form method="POST">
    <label for="name">name</label>
    <input type="text" id="name" name="name" required>
    <label for="email">email</label>
    <input type="email" id="email" name="email" required>
    <label for="password">password</label>
    <input type="password" id="password" name="password" required>
    <input type="submit" value="Create Account">
    <!-- <a href="index.php"> Cancel</a> -->
  </form>
</body>
</html>
