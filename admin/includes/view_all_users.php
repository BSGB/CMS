<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Email</th>
      <th>Role</th>
      <th>Created On</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = "SELECT * FROM users";
    $result = $connection->query($query);
    checkQueryExecution($result);
    while($row = $result->fetch_assoc()){
      $userId = $row['user_id'];
      $username = $row['username'];
      $userPassword = $row['user_password'];
      $userFName = $row['user_firstname'];
      $userLName = $row['user_lastname'];
      $userEmail = $row['user_email'];
      $userRole = $row['user_role'];
      $userCrt = $row['user_date'];


      echo "<tr>";
      echo "<td>{$userId}</td>";
      echo "<td>{$username}</td>";
      echo "<td>{$userFName}</td>";
      echo "<td>{$userLName}</td>";
      echo "<td>{$userEmail}</td>";
      echo "<td>{$userRole}</td>";
      echo "<td>{$userCrt}</td>";
      echo "<td><a href='users.php?source=delete_user&delete_id={$userId}'>Delete</a></td>";
      echo "<td><a href='users.php?source=switch_user_role&switch_id={$userId}'>Switch Role</a></td>";
      echo "<td><a href='users.php?source=edit_user&edit_id={$userId}'>Edit</a></td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>
