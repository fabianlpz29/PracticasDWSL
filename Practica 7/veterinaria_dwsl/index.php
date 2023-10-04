<?php
require 'constantes.php';
$css = CDN_BS_CSS;
$js = CDN_BS_JS;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <?= $css ?>
    <?= $js ?>
</head>

<body>
    <div class="row p-5">
        <div class="col-md-6">
            <h3>Ingresar a especies</h3>
            <form action="views/especies/index.php" method="post">
                <button class="btn btn-primary" type="submit">Ingresar</button>
            </form>
        </div>
        <div class="col-md-6">
            <h3>Ingresar a razas</h3>
            <form action="views/razas/index.php" method="post">
                <button class="btn btn-primary" type="submit">Ingresar</button>
            </form>
        </div>
    </div>
</body>

</html>