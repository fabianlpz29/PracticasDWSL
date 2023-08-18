<?php
$post = isset($_POST['post'])  ? $_POST['post'] : '';
$get = isset($_GET['get'])  ? $_GET['get'] : '';
$checkbox = isset($_POST['genero']) ? $_POST['genero'] : '';

echo '<h1>'. $post . '</h1>';
echo '<h1>'. $get . '<h1>';
print_r($checkbox);
?>