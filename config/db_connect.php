<?php
        $conn = mysqli_connect('mysql', 'root', '123456', 'ninja_pizzas');

        if(!$conn){
            echo "errors" . mysqli_connect_errno();
        }

?>