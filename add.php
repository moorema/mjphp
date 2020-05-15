<?php


include('./config/db_connect.php');
$title = $email = $ingredients = '';//初始化变量
$errors = array('email' => '', 'title' => '', 'ingredients' => '');
if (isset($_POST['submit'])) {

  //检查email(php内置过滤器):
  if (empty($_POST['email'])) {
    $errors['email'] =  'An email is required <br>';
  } else {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] =  'email must be a valid email address';
    }
  }

  //检查title（正则表达式）:
  if (empty($_POST['title'])) {
    $errors['title'] =  'An title is required <br>';
  } else {
    $title = $_POST['title'];
    if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
      $errors['title'] =  'Title must be letters and spaces only';
    }
  }

  //检查:ingredients（正则表达式）：
  if (empty($_POST['ingredients'])) {
    $errors['ingredients'] =  'An ingredients is required <br>';
  } else {
    $ingredients = $_POST['ingredients'];
    if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
      $errors['ingredients'] =  'Ingredients must be a comma separated list';
    }
  }
//检查是否有错误了，正确跳转到index.php,错误则在本页面提示错误让用户重新输入数据
  if(array_filter($errors)){

  }else{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

    //创建sql
    $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";
    if(mysqli_query($conn, $sql)){
      header('location: index.php');
    }else{
      echo 'query error: ' . mysqli_errno($conn);
    }
    
    
    
  }



}//结束检查
?>

<!DOCTYPE html>
<html>

<?php include('./templates/header.php'); ?>

<div class="container text-center">
  <h4 class="text-center">Add a pizza</h4>
  <form action="" method="post">
    <div class="form-group">
      <label>Ypur Email:</label>      
      <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
      <div class="text-danger"><?php echo $errors['email']; ?></div>
    </div>
    <div class="form-group">
      <label>Pizza Tittle:</label>
      <input type="text" class="form-control" name="title" value="<?php echo $title ?>">
      <div class="text-danger"><?php echo $errors['title']; ?></div>
    </div>
    <div class="form-group">
      <label>Ingredients:</label>
      <input type="text" class="form-control" name="ingredients" value="<?php echo $ingredients ?>">
      <div class="text-danger"><?php echo $errors['ingredients']; ?></div>
    </div>
    <button type="submit" name="submit" value="submit" class="btn btn-secondary">Submit</button>
  </form>
</html>