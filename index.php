

<?php
$title = 'Inicio'; // Título de la página
$is_home = true; // Indica que estamos en la página de inicio
include 'header.php'; // Incluir el encabezado
include 'menu.php'; // Incluir el menú
?>


<section id="inicio">
    <h1>Bienvenido a Tapicería Ficticia</h1>
    <p>Transformamos tus espacios con estilo y confort. Descubre nuestros servicios y productos personalizados.</p>
    
    <div class="servicios-destacados">
        <h2>Servicios Destacados</h2>
        <div class="servicio">
            <i class="fas fa-couch"></i>
            <h3>Tapicería de Muebles</h3>
            <p>Renueva tus muebles con nuestras telas de alta calidad y un acabado profesional.</p>
        </div>
        <div class="servicio">
            <i class="fas fa-bed"></i>
            <h3>Restauración de Muebles</h3>
            <p>Deja que nuestros expertos devuelvan la vida a tus muebles antiguos.</p>
        </div>
        <div class="servicio">
            <i class="fas fa-car"></i>
            <h3>Tapicería Automotriz</h3>
            <p>Mejora la estética de tu vehículo con nuestros servicios de tapicería automotriz.</p>
        </div>
    </div>

    <div class="cta">
        <h2>¡Solicita tu Cotización!</h2>
        <p>Contáctanos para una cotización personalizada y descubre cómo podemos ayudarte.</p>
        <a href="contacto.php" class="btn">Contáctanos</a>
    </div>
</section>

<?php include 'footer.php'; // Incluir el pie de página ?>

