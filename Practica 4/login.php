<?php
include './dp.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "INSERT INTO tbl_usuario (username, password) VALUES ('$username','$password')";
    if($enlace->query($sql)){
        echo "New record created succeefuly";
    }else{
        echo "Error: ".$sql . "<br>" . $enlace->error;
    }
}
?>
