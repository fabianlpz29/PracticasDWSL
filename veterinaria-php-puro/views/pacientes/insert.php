<?php
require '../../controllers/PacientesController.php';
require  '../../constantes.php';
$css = CDN_BS_CSS;
$js = CDN_BS_JS;
$icons = CDN_ICONOS;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    crearRegistroPaciente($_POST, $_FILES);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear paciente</title>
    <?= $css ?>
    <?= $icons ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FFC0CB;">
        <a class="navbar-brand" href="../../index.php"> <img src="../../img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">Veterinaria UNIVO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item text-white">
                    <a class="nav-link" href="../especies/index.php">Especies</a>
                </li>
                <li class="nav-item text-white">
                    <a class="nav-link " href="../razas/index.php">Razas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Pacientes</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="row p-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Crear paciente</h3>
                </div>
                <div class="card-body">
                    <form action="insert.php" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="nombre"><b>Escriba el nombre del paciente:</b></label>
                                <input class="form-control" type="text" name="nombre" id="nombre">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="vacunas"><b>Vacunas:</b></label>
                                <input class="form-control" type="text" name="vacunas" id="vacunas">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="id_raza"><b>Raza:</b></label>
                                <select class="form-control" name="id_raza" id="id_raza">
                                    <?php
                                    $razas = obtenerRazas();
                                    foreach ($razas as $raza) {
                                        echo '<option value="' . $raza['id_raza'] . '">' . $raza['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="enfermedades"><b>Seleccione las enfermedades:</b></label><br>
                                <div class="form-group form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="enfermedades[]" id="sarna" value="Sarna">
                                    <label class="form-check-label" for="sarna">Sarna</label>
                                </div>
                                <div class="form-group form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="enfermedades[]" id="rabia" value="Rabia">
                                    <label class="form-check-label" for="rabia">Rabia</label>
                                </div>
                                <div class="form-group form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="enfermedades[]" id="gripe" value="Gripe">
                                    <label class="form-check-label" for="gripe">Gripe</label>
                                </div>
                                <div class="form-group form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="enfermedades[]" id="jiote" value="Jiote">
                                    <label class="form-check-label" for="jiote">Jiote</label>
                                </div>
                                <div class="form-group form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="enfermedades[]" id="ninguna" value="Ninguna">
                                    <label class="form-check-label" for="ninguna">Ninguna</label>
                                </div>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="imagenes"><b>Seleccionar imagen</b></label>
                                <input class="form-control" type="file" name="imagenes" id="imagenes">
                            </div>
                            <div class="col-md-12 mt-2">
                                <button class="btn btn-primary" type="submit">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?= $js ?>
</body>

</html>