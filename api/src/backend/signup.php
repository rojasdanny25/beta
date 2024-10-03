<?php
    //DB conection 
    require('../../config/db_connection.php');
    //get data from register

    $email =$_POST['email'];
    $pass = $_POST['passwd'];
    $enc_pass = md5($pass);

  

    $query = "INSERT INTO users (email, password)
     VALUES ('$email', '$enc_pass')
     ";

    $result = pg_query($conn, $query);

    if($result){
        echo "Registration successful";
    }else{ 
        echo "Registration failed";
    }
    pg_close($conn);
?>


 