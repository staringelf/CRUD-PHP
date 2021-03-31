<?php
  require_once "pdo.php";
  require_once "header.php";
  session_start();
  if( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user_id']) ){
    $sql = "UPDATE Users SET name = :name, email = :email, password = :password 
              WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':name' => $_POST['name'],
      ':email' => $_POST['email'],
      ':password' => $_POST['password'],
      ':user_id' => $_POST['user_id']
    ));
    $_SESSION['success'] =  'Successfully updated!';
    header('Location: index.php');
    return;
  }

  //GET From query
  
  $stmt = $pdo->prepare("SELECT * FROM Users WHERE user_id = :id");
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
<body>
  <h2> Edit Account </h2>
  <p><a href="index.php">See Index</a></p>
  <?php 
    require_once "flash.php";
  ?>
  <?php
    $name = htmlentities($row['name']);
    $email = htmlentities($row['email']);
    $password = htmlentities($row['password']);
    $user_id = $row['user_id'];
  ?>
  <form method="POST">
    <label for="name">name</label>
    <input type="text" id="name" name="name" value="<?= $name ?>" required>
    <label for="email">email</label>
    <input type="email" id="email" name="email" value="<?= $email ?>" required>
    <label for="password">password</label>
    <input type="password" id="password" name="password" value="><?= $password ?>" required>
    <input type="hidden" value="<?= $user_id ?>" name="user_id">
    <input type="submit" value="Update">
    <!-- <a href="index.php"> Cancel</a> -->
  </form>
</body>
</html>