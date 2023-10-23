<?php
include_once 'conexion.php';
$years = isset($_POST['years']) ? $_POST['years'] : [];
$stringY = '';
if ($years != []) {
    foreach($years as $index=>$y){
        if($index == count($years) - 1){
            $stringY .= "'%$y%'";
            continue;
        }
        $stringY .= "'%$y%' OR fecha LIKE ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <title>Gráfica con Filtros</title>
</head>

<body>
    <form action="index.php" method="POST" style="text-align:center">
        <label for="">Totale anuales >= que </label>
        <input type="text" name="totales" id="totales" value="<?php echo isset($_POST['totales']) ? $_POST['totales'] : "" ?>">
        <?php
        $anios = "SELECT DISTINCT year(fecha) as anio 
            FROM encabezado_fact WHERE year(fecha) BETWEEN 2013 and 2022 order by(fecha) asc;";
        $ejecucion = mysqli_query($conexion, $anios);

        while ($seleccionAnios = mysqli_fetch_array($ejecucion)) {
            $existe = '';
            if (in_array($seleccionAnios[0], $years)) {
                $existe = 'checked';
            }
            echo "<label>" . $seleccionAnios[0] . "</label>";
            echo "<input name='years[]' $existe  value='$seleccionAnios[0]' type='checkbox' name='' id=''>";
        }
        ?>
        <input type="submit" value="Graficar">
    </form>

    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>
    <?php
    include_once 'conexion.php';
    ?>
</body>

</html>
<script>
    Highcharts.chart('container', {

        title: {
            text: 'Empresa XYZ',
            align: 'center'
        },

        subtitle: {
            text: 'Total de ventas anuales de los ultimos 10 años',
            align: 'center'
        },

        yAxis: {
            title: {
                text: 'Ventas en $'
            }
        },

        xAxis: {
            accessibility: {
                rangeDescription: 'Desde 2013 al 2022'
            }
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 2013
            }
        },

        series: [{
            name: 'Ventas anuales',
            data: [
                <?php
                $totales = isset($_POST['totales']) ? $_POST['totales'] : "";


                if($years !== [] && $totales !== ""){
                    $consulta = "SELECT sum(venta) as venta, fecha  from detalle_fact
                    inner join encabezado_fact on detalle_fact.codigo=encabezado_fact.codigo
                    WHERE fecha LIKE $stringY
                    GROUP by YEAR(fecha) 
                    HAVING sum(venta) >= $totales";
                    $executar = mysqli_query($conexion, $consulta);
                    while ($dato = mysqli_fetch_array($executar)) {
                        $d = number_format($dato[0], 2, '.', '');
                        echo $dato[0] . ",";
                    }
                }else if ($totales !== "") {
                    $consulta = "SELECT sum(venta) as venta, fecha  from detalle_fact
                    inner join encabezado_fact on detalle_fact.codigo=encabezado_fact.codigo
                    GROUP by YEAR(fecha)
                    HAVING sum(venta) >= $totales";
                    $executar = mysqli_query($conexion, $consulta);
                    while ($dato = mysqli_fetch_array($executar)) {
                        $d = number_format($dato[0], 2, '.', '');
                        echo $dato[0] . ",";
                    }
                } else if ($years !== []) {
                    $consulta = "SELECT sum(venta) as venta, fecha  from detalle_fact
                    inner join encabezado_fact on detalle_fact.codigo=encabezado_fact.codigo
                    WHERE fecha LIKE $stringY
                    GROUP by YEAR(fecha)";
                    $executar = mysqli_query($conexion, $consulta);
                    while ($dato = mysqli_fetch_array($executar)) {
                        $d = number_format($dato[0], 2, '.', '');
                        echo $dato[0] . ",";
                    }
                } else if ($totales === "") {
                    $consulta = "SELECT sum(venta) as venta, fecha  from detalle_fact
                    inner join encabezado_fact on detalle_fact.codigo=encabezado_fact.codigo
                    GROUP by YEAR(fecha)";
                    $executar = mysqli_query($conexion, $consulta);
                    while ($dato = mysqli_fetch_array($executar)) {
                        $d = number_format($dato[0], 2, '.', '');
                        echo $dato[0] . ",";
                    }
                }


                ?>
            ]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
</script>