<?php 
/*
$number1 = 20;
$number2 =30;

$addition = $number1 + $number2;

echo $addition;
*/
/* database connection
developer: Danny 
*/

$host = "localhost";
$username = "postgres";
$password = "sistemas2024";
$dbname = "beta";
$port = "5432";

$data_connection = "
    host        =  $host
    port        =  $port 
    dbname      =  $dbname
    user        =  $username 
    password    =  $password
    ";

$conn = pg_connect($data_connection);

if (!$conn){
    die("Connection failed: ". pg_last_error());
}else{
    echo "Connected successfully";
}
pg_close($conn);

?>