<?php

    include('./config/db_connect.php');
    //编写sql查询语句
    $sql = 'SELECT title, ingredients, id FROM pizzas';
    //查询语法发送给数据库查询
    $result = mysqli_query($conn, $sql);
    //获取查询到的数据并存储到数组中
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //查询完成，释放连接
    mysqli_free_result($result);
    //关闭连接
    mysqli_close($conn);
    // print_r($pizzas);

?>


<!DOCTYPE html>
<html lang="en">
<?php include('./templates/header.php'); ?>

<h4 class="text-center text-black-50">Pizzas!</h4>
<div class="neiron">
    <div class="container">
        <div class="row">
            <?php   foreach($pizzas as $pizza){  ?>


            <div class="col-md ">

                <div class="card" style="width: 18rem;">
                    <img src="https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=1392272998,1906752080&fm=26&gp=0.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">
                            <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                            <ul>
                                <?php foreach(explode(',', $pizza['ingredients']) as $ing ) {?>
                                    <li><?php echo htmlspecialchars($ing); ?></li>    
                                <?php }?>
                            </ul>
                          
                            
                        </p>
                    
                    </div>
                   
                </div>
                <a  class="text-warning" href="details.php?id=<?php echo $pizza['id'] ?>">more info </a>

            </div>

            <?php } ?>
        </div>
    </div>
</div>






<?php include('./templates/footer.php'); ?>


</body>

</html>