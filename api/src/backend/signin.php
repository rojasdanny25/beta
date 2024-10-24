<?php
   //DB CONECTION
   require('../../config/db_connection.php');


   //GET DATA FROM FORM SUBMISSION 

   $email =$_POST['email'];
   $pass = $_POST['passwd'];

   $enc_pass = md5($pass);

   //QUERY
   $query = "select * from users where email='$email' and password='$enc_pass'";
    $result = pg_query($conn, $query);
    $row = pg_fetch_assoc($result);

    if($row){
        header('refresh:0; url=http://127.0.0.1/beta/api/src/home.php');

    } else {
        echo "<script>alert('invalid email or password!')</script>";
        header('refresh:0; url=http://127.0.0.1/beta/api/src/login_form.html');
    }


?>