<?php
    function save_data_supabase($email, $passwd){
        // supabase database configuration
        $SUPABASE_URL = 'https://brievbewdyucswgrlece.supabase.co';
        $SUPABASE_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJyaWV2YmV3ZHl1Y3N3Z3JsZWNlIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzA0NzU2OTMsImV4cCI6MjA0NjA1MTY5M30.C1cDvEVdKov6f-WodI2P2m6HdTSygP6hI6rlp96I7os';
        $url = "$SUPABASE_URL/rest/v1/users/";
        $data = [
            'email' => $email,
            'password' => $passwd,

        ];

        $options = [
            'http' => [
                'header'  => [
                    "Content-type: application/json",
                    "Authorization: Bearer $SUPABASE_KEY",
                    "apikey: $SUPABASE_KEY"
                    ],
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $data = json_decode($response, true);

        if($response === false) {
            echo "Error: Unable to save data to Supabase";
            exit;
        }

        echo "User has been created" , json_encode($response_data);
        
    }
    
    
    
    
    
    
    //DB conection 
    require('../../config/db_connection.php');
    //get data from register

    $email =$_POST['email'];
    $pass = $_POST['passwd'];

    //encript password with md5 hashing algorithm
    $enc_pass = md5($pass);

    //validate if email already exists
    $query = "select * from users where email='$email'";
    $result = pg_query($conn, $query);
    $row = pg_fetch_assoc($result);
    if($row){
        echo "<script>alert('Email already exists')</script>";
        header('refresh:0; url=http://127.0.0.1/beta/api/src/register_form.html');
        exit();
    }
  
    //query to inser date into users table
    $query = "INSERT INTO users (email, password)
     VALUES ('$email', '$enc_pass')
     ";
    //execute query 
    $result = pg_query($conn, $query);

    if($result){
       // echo "Registration successful";
       echo "<script>alert('Registration successful')</script>";
       header('refresh:0; url=http://127.0.0.1/beta/api/src/login_form.html');
    }else{ 
        echo "Registration failed";
    }
    pg_close($conn);
?>


 