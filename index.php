<?php
    require_once "pdo.php";
    require_once "header.php";
    session_start();
?>

<body>
<?php
  require_once "flash.php";
  echo '<table border="2">'."\n";
  $stmt = $pdo->query("SELECT name, email, password, user_id FROM Users");
  while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<tr><td>";
    echo(htmlentities($row['user_id']));
    echo("</td><td>");
    echo(htmlentities($row['name']));
    echo("</td><td>");
    echo(htmlentities($row['email']));
    echo("</td><td>");
    echo(htmlentities($row['password']));
    echo("</td><td>");
    echo('<a href="edit.php?user_id='.$row['user_id'].'">Edit</a> / ');
    echo('<a href="delete.php?user_id='.$row['user_id'].'">Delete</a> / ');
    echo("\n</form>\n");
    echo("</td></tr>\n");
}
?>
</table>
<a href="add.php">Add New</a>
</body>
</html>