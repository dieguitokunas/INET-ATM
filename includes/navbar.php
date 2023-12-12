<link rel="stylesheet" href="estilos/index.css">
<script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous" ></script>
<header class="header">
    <nav class="nav">
        <h1 class="logo nav-link"><a href="index.php">Inet</a></h1>
        <div class="conteiner">

        </div class="">
        <button class="nav-toggle" aria-label="Abrir menú">
            <i class="fas fa-bars"></i>
        </button>
        <ul class="nav-menu" >
            <li class="nav-menu-item"><a href="index.php" class="nav-menu-link nav-link">Inicio</a></li>
            
            <form action="" method="GET" class="contenedor-buscar">
                <div class="busca">
                    <input type="text" placeholder="Buscar" name="buscador" class="buscador">
                    <button type="submit" class="fas fa-search"></button>
                </div>
                
            </form>
                <form action="" method="GET" class="contenedor-select">
                <select name="ofertas" class= "ofertas">
                    <option value="">Seleccione una oferta</option>
                    <?php
                    $ofertas_fil=$con->query("SELECT ofertas FROM ofertas");
                    while($row=$ofertas_fil->fetch_assoc()){
                        echo '<option value="'. $row['ofertas'] .'">'. $row['ofertas'] .'</option>';
                    }
                    ?>
                </select>
                <select name="jurisdicciones" class="jurisdicciones">
                    <option value="">Seleccione una jurisdiccion</option>
                    <?php 
                    $jurisdicciones=$con->query("SELECT jurisdiccion FROM jurisdicciones");
                    while ($row=$jurisdicciones->fetch_assoc()){
                        echo '<option value="'.$row["jurisdiccion"].'">'.$row["jurisdiccion"].'</option>';
                    }
                    ?>
                </select>
                <select name="localidades" class="localidades">
                    <option value="">Seleccione una localidad</option>
                    <?php
                    $localidades=$con->query("SELECT DISTINCT localidad FROM localidades inner join jurisdicciones on localidades.id_jurisdiccion=jurisdicciones.id_jurisdiccion ORDER BY localidad ASC");
                    while($row=$localidades->fetch_assoc()){
                        echo '<option value="'.$row["localidad"].'">'.$row["localidad"].'</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="Filtrar" name="enviar_filtro">
            </form>
        </ul>
        </nav>
        </header>
        <script>
            const navToggle = document.querySelector(".nav-toggle");
    const navMenu = document.querySelector(".nav-menu");

    navToggle.addEventListener("click", () => {
        navMenu.classList.toggle("nav-menu_visible");

        if (navMenu.classList.contains("nav-menu_visible")) {
            navToggle.setAttribute("aria-label", "Cerrar menu");
        } else {
            navToggle.setAttribute("aria-label", "Abrir menu");
        }
    });
</script>