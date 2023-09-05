<?php
include './dp.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM tbl_usuario WHERE username = '$username' AND password = '$passworrd'";
    $result = $enlace->query($sql);
    if (mysqli_fetch_assoc($result) >0){
        echo "id: ". $row["id_usuario"]
        . ", Name: "
        . $row["username"];
    }

}
?>