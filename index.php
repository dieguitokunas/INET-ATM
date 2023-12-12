<?php
require './admin/db/conexion.php';
$ofertas = $con->query("SELECT * FROM apertura_ofertas inner join direcciones on apertura_ofertas.cue_num=direcciones.cue_num
inner join lista_atm on direcciones.cue_num=lista_atm.cue_num limit 10");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>INET|Instituto Nacional de Educación Tecnológica</title>
</head>

<body>
  <div class="app">
    <?php
    require './includes/navbar.php';
    ?>
    <section class="ofertas">
      <h2>Ultimas ofertas de ATM</h2>
      <div class="carrusel-contenedor">
        <article class="carrusel">
          <div class="carrusel-titulo">
            <?php
            while ($row = $ofertas->fetch_assoc()) {
              echo '<article class="carrusel">';
              echo '<a href=detalles.php?cue_num=' . $row["cue_num"] . '><div class="carrusel-titulo">';
              echo '<p>' . $row["oferta"] . '</p>';
              echo '<p>' . $row["jurisdiccion"] . '</p>';
              echo '</div>';
              echo '<div class="carrusel-desc">';
              echo '<p>' . $row["desc_oferta"] . '</p>';
              echo '</div>';
              echo '<div class="carrusel-fecha">';
              echo '<p>Inicia: ' . $row["fecha_inicio"] . '</p>';
              echo '<p> Finaliza: ' . $row["fecha_finalizacion"] . '</p>';
              echo '</div></a>';
              echo '</article>';

            }
            ?>
    </section>
    <main class="cards-contenedor">
      <?php
      $atm = $con->query("SELECT lista_atm.cue_num,atm_num,jurisdiccion,localidad,oferta from lista_atm inner join direcciones on lista_atm.cue_num=direcciones.cue_num");

      if (isset($_GET["enviar_filtro"])){
        $sql_filtro="SELECT lista_atm.cue_num,atm_num,jurisdiccion,oferta,localidad from lista_atm inner join direcciones on lista_atm.cue_num=direcciones.cue_num WHERE 1";
        $ofertas=$_GET["ofertas"];
        $jurisdicciones=$_GET["jurisdicciones"];
        $localidades=$_GET["localidades"];

        if ($ofertas!==""){
          $sql_filtro .=" AND oferta='$ofertas'";
        }
        if ($jurisdicciones!==""){
          $sql_filtro .=" AND jurisdiccion='$jurisdicciones'";
        }
        if ($localidades!==""){
          $sql_filtro .=" AND localidad='$localidades'";
        }
        $query=$con->query($sql_filtro);
        }else{
        $query=$atm;
      }



      if (isset($_GET['buscador'])) {
        $buscar = $_GET["buscador"];
        if ($buscar!== ""){
        $sql_buscador = "SELECT lista_atm.cue_num,atm_num,jurisdiccion,localidad,oferta from lista_atm inner join direcciones on lista_atm.cue_num=direcciones.cue_num WHERE CONCAT (jurisdiccion,localidad, oferta) like '%$buscar%'";
        $query = $con->query($sql_buscador);
        if (!$query) {
          die("Error en la consulta: " . $con->error);
        }
      }

      }
      if ($query->num_rows> 0){
      while ($row = $query->fetch_assoc()) {
        echo '<a href=detalles.php?cue_num=' . $row["cue_num"] . '><div class="atm-contenedor">';
        echo '<div class="atm-contenedor-portada">';
        echo '<div class="atm-num"><p>' . $row["atm_num"] . '</p></div>';
        echo '</div>';
        echo '<div class="atm-contenedor-detalles">';
        echo '<div class="atm-juris"><p>JURISDICCION: ' . $row["jurisdiccion"] . '</p></div>';
        echo '<div class="atm-local"><p>LOCALIDAD: ' . $row["localidad"] . '</p></div>';
        echo '<div class="atm-oferta"><p>OFERTA FORMATIVA: ' . $row["oferta"] . '</div>';
        echo '</p></div>';
        echo '</div></a>';
      }}else{
        echo '<center><h2 style="color:#fff;">No hay resultados coincidentes</h2></center>';
      }
      ?>

  </div>
  </main>
  </div>
  <?php
  require './includes/footer.php';
  ?>
</body>


</html>