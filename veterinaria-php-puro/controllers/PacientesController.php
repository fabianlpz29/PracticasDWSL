    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/veterinaria-php-puro/db/db.php';

    function obtenerPacientes()
    {
        $query = "SELECT * from tbl_pacientes";
        $smt = conectarDb()->prepare($query);
        $smt->execute();
        $data = $smt->fetchAll(PDO::FETCH_OBJ);

        return $data;
    }

    function crearRegistroPaciente($post, $files)
    {
        $imagen = guardarImagen($files);

        $enfermedades = implode(", ", $post['enfermedades']);

        $query = "INSERT INTO tbl_pacientes 
        (
            nombre, enfermedades, vacunas, id_raza, imagen, fecha_creacion, 
            fecha_actualizacion, creado_por, actualizado_por, fecha
        ) VALUES
        (
            :nombre, :enfermedades, :vacunas, :id_raza, :imagen, :fecha_creacion, 
            :fecha_actualizacion, :creado_por, :actualizado_por, :fecha
        )";

        $data = [
            ':nombre' => $post['nombre'], ':enfermedades' => $enfermedades, ':vacunas' => $post['vacunas'],
            ':id_raza' => $post['id_raza'], ':imagen' => $imagen, ':fecha_creacion' => date('Y-m-d H:i:s'),
            ':fecha_actualizacion' => date('Y-m-d H:i:s'), ':creado_por' => 1,
            ':actualizado_por' => 1, ':fecha' => date('Y-m-d')
        ];
        $stmt = conectarDb()->prepare($query);
        $stmt->execute($data);
        header('Location: index.php');
    }


    function obtenerRazas()
    {
        $query = "SELECT * FROM tbl_razas";
        $stmt = conectarDb()->prepare($query);
        $stmt->execute();
        $razas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $razas;
    }


    function guardarImagen($files)
    {
        $carpeta = 'imagenes';

        $infoExtension = explode(".", $files["imagenes"]["name"]);
        $extension = $infoExtension[1];

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $aleatorio = substr(str_shuffle($permitted_chars), 0, 10);

        $imagen = $carpeta . "/" . $aleatorio . "." . $extension;
        $tmp = $files["imagenes"]["tmp_name"];

        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777);

            if (!move_uploaded_file($tmp, $imagen)) {
                header('Location: index.php');
            }
        } else {
            if (!move_uploaded_file($tmp, $imagen)) {
                header('Location: index.php');
            }
        }

        return $imagen;
    }

    function actualizarPaciente($post)
    {
        $query = "UPDATE tbl_pacientes SET nombre = :nombre, vacunas = :vacunas, enfermedades = :enfermedades, estado = :estado, fecha_actualizacion = :fecha_actualizacion WHERE id_paciente = :id_paciente";

        $paciente = [
            ':nombre' => $post['nombre'],
            ':vacunas' => $post['vacunas'],
            ':enfermedades' => implode(', ', $post['enfermedades']),
            ':estado' => $post['estado'],
            ':fecha_actualizacion' => date('Y-m-d H:i:s'),
            ':id_paciente' => $post['id_paciente']
        ];

        $stmt = conectarDb()->prepare($query);
        if ($stmt->execute($paciente)) {
            // La consulta se ejecutó correctamente, redirige
            header('Location:index.php');
        } else {
            // La consulta falló, muestra un mensaje de error o registra el error.
            echo "Error en la consulta: " . implode(" - ", $stmt->errorInfo());
        }
    }



    function obtenerPacientePorId($id_paciente)
    {
        $query = "SELECT * FROM tbl_pacientes WHERE id_paciente = :id_paciente";
        $stmt = conectarDb()->prepare($query);
        $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
        $stmt->execute();
        $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

        return $paciente;
    }


    function borrarPaciente($id)
    {
        try {
            $query = "DELETE FROM tbl_pacientes WHERE id_paciente = :id_paciente";
            $stmt = conectarDb()->prepare($query);
            $data = [':id_paciente' => $id];
            $stmt->execute($data);
            header('Location: index.php');
        } catch (PDOException $e) {
            $_SESSION['error'] = "error";
            $_SESSION['error-message'] = "<script>
            Swal.fire({
                title: 'Error',
                text: '" . $e->getMessage() . "',
                showCancelButton: true,
                icon: 'error',
                confirmButtonText: 'Continuar',
                cancelButtonText: `Cancelar`,
            })
        </script>";
        }
    }
