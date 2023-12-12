<?php
require './admin/db/conexion.php';

if (isset($_GET["cue_num"])) {
    $cue = $_GET["cue_num"];
    $detalles = $con->query("SELECT * FROM lista_atm 
    INNER JOIN contactos ON lista_atm.cue_num = contactos.cue_num 
    INNER JOIN direcciones ON contactos.cue_num = direcciones.cue_num
    INNER JOIN apertura_ofertas ON direcciones.cue_num = apertura_ofertas.cue_num where lista_atm.cue_num='$cue'");
    
    $detalles ? $results=$detalles->fetch_assoc() : ($con->close() and die('Error'));

         
    
} else {
    header("location:index.php");
    exit; 
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/detalle.css">
    <title>results del ATM</title>
</head>

<body>
    <div class="app">
        <?php
        require './includes/navbar.php';
        ?>

        <section class="detalles-cont">
            <article class="atm-detalles">
                <div class="atm-detalles-header">
                    <div class="atm-detalles-num">
                        <p>Numero de ATM: <?php echo isset($results["atm_num"]) ? $results["atm_num"] : "N/A"; ?></p>
                    </div>
                    <div class="atm-detalles-direccion">
                        <p>Jurisdicción: <?php echo isset($results["jurisdiccion"]) ? $results["jurisdiccion"] : "N/A"; ?></p>
                        <p>Localidad: <?php echo isset($results["localidad"]) ? $results["localidad"] : "N/A"; ?></p>
                            <a href="<?php echo $results["coord_ubicacion"]; ?>">Ubicación</a>
                    </div>
                </div>
                <div class="atm-detalles-main">
                    <div class="atm-detalles-main-info">
                        <h2>Información</h2>
                        <ul>
                            <li>Numero de CUE: <p><?php echo isset($results["cue_num"]) ? $results["cue_num"] : "N/A"; ?></p></li>
                            <li>Numero de ATM: <p><?php echo isset($results["atm_num"]) ? $results["atm_num"] : "N/A"; ?></p></li>
                            <li>Oferta formativa: <p><?php echo isset($results["oferta"]) ? $results["oferta"] : "N/A"; ?></p></li>
                            <li>Estado del ATM: <p><?php echo isset($results["estado"]) ? $results["estado"] : "N/A"; ?></p></li>
                        </ul>
                    </div>
                    <div class="atm-detalles-ofertas">
                        <h2>Ofertas formativas abiertas</h2>
                        <ul>
                            <p>Nombre de la oferta: <span><?php echo isset($results["oferta"]) ? $results["oferta"] : "N/A"; ?></span></p>
                            <p class="desc">Descripción de la oferta: <span><?php echo isset($results["desc_oferta"]) ? $results["desc_oferta"] : "N/A"; ?></span></p>
                            <p>Familia profesional de la oferta: <span><?php echo isset($results["familia_oferta"]) ? $results["familia_oferta"] : "N/A"; ?></span></p>
                            <p>Fecha de inicio de la oferta: <span><?php echo isset($results["fecha_inicio"]) ? $results["fecha_inicio"] : "N/A"; ?></span></p>
                            <li>Fecha de finalización de la oferta: <p><?php echo isset($results["fecha_finalizacion"]) ? $results["fecha_finalizacion"] : "N/A"; ?></p></li>
                        </ul>
                    </div>
                    <div class="atm-detalles-contacto">
                        <h3>Información de contacto</h3>
                        <p>Email: <span><?php echo isset($results["email"]) ? $results["email"] : "N/A"; ?></span></p>
                        <p>Teléfono: <span><?php echo isset($results["tel"]) ? $results["tel"] : "N/A"; ?></span></p>
                    </div>
                </div>
            </article>
        </section>
        <?php
        require './includes/footer.php';
        ?>
        </div>
</body>

</html>
