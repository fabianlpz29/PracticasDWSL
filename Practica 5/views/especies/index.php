<?php
require '../../db/db.php';
require '../../constantes.php';
$css = CDN_BS_CSS;
$js = CDN_BS_JS;

$query = 'SELECT * FROM tbl_razas';
$ejecutar = mysqli_query($db, $query);
$data = $ejecutar->fetch_array();
$mensaje;
if ($data != null) {
    foreach ($data as $row) {
        echo $row["nombre"];
    }
} else {
    $mensaje = "No existen registros";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select</title>
    <?= $css ?>
    <?= $js ?>
</head>

<body>
    <?= $mensaje ?>
    <?= date("y-m-d H:i:s") ?>
</body>

</html>