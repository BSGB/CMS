<?php
function checkQueryExecution($result){
  global $connection;
  if(!$result){
    die("QUERY FAILED: " . $connection->error());
  }
}

function insertCategory(){
  global $connection;
  if(isset($_POST['submitAdd'])){
    $catTitle = $_POST['catTitle'];
    if($catTitle == "" || empty($catTitle)){
      echo "This field cannot be empty";
    } else {
      $query = "INSERT INTO categories(cat_title) VALUES('{$catTitle}')";
      $result = $connection->query($query);
      checkQueryExecution($result);
    }
  }
}

function deleteCategory(){
  if(isset($_GET['delete'])){
    global $connection;
    $deleteId = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id={$deleteId}";
    $result = $connection->query($query);
    checkQueryExecution($result);
    header("Location: categories.php");
  }
}

function fillCategoriesTable() {
  global $connection;
  $query = 'SELECT * FROM categories';
  $result = $connection->query($query);
  checkQueryExecution($result);
  while($row = $result->fetch_assoc()){
    $catId = $row['cat_id'];
    $catTitle = $row['cat_title'];
    echo "<tr>";
    echo "<td>{$catId}</td>";
    echo "<td>{$catTitle}</td>";
    echo "<td><a href='categories.php?delete={$catId}'>Delete</a></td>";
    echo "<td><a href='categories.php?edit={$catId}'>Edit</a></td>";
    echo "</tr>";
  }
}

function updateCategoryInput(){
  global $connection;
  global $editId;
  $query = "SELECT * FROM categories WHERE cat_id={$editId}";
  $result = $connection->query($query);
  checkQueryExecution($result);
  while($row = $result->fetch_assoc()){
    $catId = $row['cat_id'];
    $catTitle = $row['cat_title'];
    ?>
    <input value="<?php if(isset($catTitle)) echo $catTitle; ?>" type="text" class="form-control" name="updateCat">
  <?php }
}

function updateCategory(){
  global $connection;
  global $editId;
  if(isset($_POST['submitEdit'])){
    $updateCat = $_POST['updateCat'];
    $query = "UPDATE categories SET cat_title = '{$updateCat}' WHERE cat_id = {$editId}";
    $result = $connection->query($query);
    checkQueryExecution($result);
    header("Location: categories.php");
  }
}

function usersOnlineAjax(){

  if(isset($_GET['onlineusers'])){
    global $connection;
    if(!$connection){

      session_start();
      include('../includes/db.php');

      $time = time();
      $timeOutInSeconds = 60;
      $timeOut = $time - $timeOutInSeconds;

      $query = "SELECT * FROM users_online WHERE time > {$timeOut}";
      $result = $connection->query($query);
      echo $count = $result->num_rows;
    }
  }
}

usersOnlineAjax();

function pokeActive(){
  global $connection;
  $session = session_id();
  $time = time();
  $timeOutInSeconds = 60;
  $timeOut = $time - $timeOutInSeconds;

  $query = "SELECT * FROM users_online WHERE session = '{$session}'";
  $result = $connection->query($query);
  $count = $result->num_rows;

  if($count == NULL) {
    $query = "INSERT INTO users_online(session, time) VALUES('{$session}', {$time})";
    $result = $connection->query($query);
  } else {
    $query = "UPDATE users_online SET time = {$time} WHERE session = '{$session}'";
    $result = $connection->query($query);
  }
}

 ?>
