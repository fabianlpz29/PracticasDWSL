<?php
require '../../db/db.php';
$query = "SELECT * FROM tbl_razas";
$ejecutar = mysqli_query($db, $query);
$data = $ejecutar->fetch_array();
$mensaje;
if($data != null){
    foreach($data as $row){
        echo $row["nombre"];
    }
}else{
    $mensaje = "NO EXISTEN REGISTROS PARA MOSTRAR";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= $mensaje?>
    <?= date("Y-m-d H:i:s")?>
</body>
</html>