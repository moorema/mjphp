<?php

include('./config/db_connect.php');

if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
        //
        header('Location:index.php');
    }{
        //
        echo "error:" . mysqli_errno($conn);
    }
}








if(isset($_GET['id'])){

    //转义字符
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    //查询
    $sql =  "SELECT * FROM pizzas WHERE id = $id";
    //获取查询结果
    $result = mysqli_query($conn, $sql);
    //抓去内容到数组中
    $pizza = mysqli_fetch_assoc($result);
    //释放连接内存
    mysqli_free_result($result);
    //关闭连接
	mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html>
<?php include('./templates/header.php'); ?>

<div class="container text-center">

        <?php if($pizza): ?>
            <h4><?php echo $pizza['title']; ?></h4>
            <p>Created by <?php echo $pizza['email']; ?></p>
			<p><?php echo date($pizza['created at']); ?></p>
			<h5>Ingredients:</h5>
            <p><?php echo $pizza['ingredients']; ?></p>
            
            <form action="details.php" method="post">
                <input type="hidden" name = "id_to_delete" value ="<?php echo $pizza['id'] ?>">
                <input type="submit" name = "delete"  value="Delete" calss = "btn btn-warning">
            </form>



        <?php else: ?>
			<h5>No such pizza exists.</h5>
		<?php endif ?>
</div>

<?php include('./templates/footer.php'); ?>


</html>