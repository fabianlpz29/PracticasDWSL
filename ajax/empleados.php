<?php
$db = new PDO(
    'mysql:host=localhost; dbname=db_ajax',
    'root',
    ''
);

$tabla = $_POST['tabla'];
$operacion = $_POST['operacion'];

if($_SERVER['REQUEST_METHOD'] == 'POST'
&& $tabla == 'employees'
&& $operacion = 'get'){
  echo json_encode(obtenerData($tabla, $db));
}

function obtenerData($tabla, $con){
    $query = "SELECT * FROM $tabla";
    $prepare = $con->prepare($query);
    $prepare->execute();
    $data = $prepare->fetchAll(PDO::FETCH_OBJ);


    return $data;


}

?>