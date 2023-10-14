<?php
require '../../controllers/PacientesController.php';
require '../../constantes.php';

$css = CDN_BS_CSS;
$js = CDN_BS_JS;
$icons = CDN_ICONOS;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    actualizarPaciente($_POST);
}


// Obtener la información del paciente por su ID
$paciente = obtenerPacientePorId($_GET['id_paciente']);

$razas = obtenerRazas();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar paciente</title>
    <?= $css ?>
    <?= $icons ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FFC0CB;">
        <a class="navbar-brand" href="../../index.php"> <img src="../../img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">Veterinaria UNIVO</a>
        <!-- Botón de navegación móvil -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú de navegación -->
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
    <div class="container">
        <div class="row p-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Editar paciente</h3>
                    </div>
                    <div class="card-body">
                    <form action="editar.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label for="nombre"><b>Nombre del paciente:</b></label>
                                    <input class="form-control" type="text" name="nombre" id="nombre" value="<?= $paciente['nombre'] ?>">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="vacunas"><b>Vacunas:</b></label>
                                    <input class="form-control" type="text" name="vacunas" id="vacunas" value="<?= $paciente['vacunas'] ?>">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="id_raza"><b>Raza:</b></label>
                                    <select class="form-control" name="id_raza" id="id_raza">
                                        <?php
                                        foreach ($razas as $raza) {
                                            $selected = ($raza['id_raza'] == $paciente['id_raza']) ? 'selected' : '';
                                            echo '<option value="' . $raza['id_raza'] . '" ' . $selected . '>' . $raza['nombre'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="enfermedades"><b>Enfermedades:</b></label><br>
                                    <?php
                                    $enfermedades = explode(', ', $paciente['enfermedades']);
                                    $checkboxes = array('Sarna', 'Rabia', 'Gripe', 'Jiote', 'Ninguna');
                                    foreach ($checkboxes as $checkbox) {
                                        $checked = (in_array($checkbox, $enfermedades)) ? 'checked' : '';
                                        echo '<div class="form-check form-check-inline">';
                                        echo '<input class="form-check-input" type="checkbox" name="enfermedades[]" id="' . strtolower($checkbox) . '" value="' . $checkbox . '" ' . $checked . '>';
                                        echo '<label class="form-check-label" for="' . strtolower($checkbox) . '">' . $checkbox . '</label>';
                                        echo '</div>';
                                    }
                                    ?>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="nombre"><b>Estado del paciente:</b></label>
                                    <br>
                                    <div class="form-check form-check-inline mt-2">
                                        <input value="1" <?= ($paciente['estado'] == 1) ? 'checked' : ''; ?> class="form-check-input" type="radio" name="estado" id="activo">
                                        <label class="form-check-label" for="activo"><b>Activo</b></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input value="0" <?= ($paciente['estado'] == 0) ? 'checked' : ''; ?> class="form-check-input" type="radio" name="estado" id="inactivo">
                                        <label class="form-check-label" for="inactivo"><b>Inactivo</b></label>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="imagenes"><b>Seleccionar imagen:</b></label>
                                    <input class="form-control" type="file" name="imagenes" id="imagenes">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <button class="btn btn-primary" type="submit">Actualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $js ?>
</body>

</html>