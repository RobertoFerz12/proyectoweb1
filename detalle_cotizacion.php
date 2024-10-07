<?php
include 'conexion.php';

// Verificar si se ha pasado el ID de la cotización
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener detalles de la cotización
    $sql = "SELECT * FROM cotizaciones WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $cotizacion = $result->fetch_assoc();
    } else {
        echo "Cotización no encontrada.";
        exit;
    }
} else {
    echo "ID de cotización no especificado.";
    exit;
}

include 'header.php';
include 'menu.php';
?>

<section id="detalle_cotizacion">
    <h2>Detalles de la Cotización</h2>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($cotizacion['nombre']) ?></p>
    <p><strong>Artículo:</strong> <?= htmlspecialchars($cotizacion['articulo']) ?></p>
    <p><strong>Tela:</strong> <?= htmlspecialchars($cotizacion['tela']) ?></p>
    <p><strong>Tiempo:</strong> <?= htmlspecialchars($cotizacion['tiempo']) ?></p>
    <p><strong>Precio Total:</strong> $<?= htmlspecialchars($cotizacion['precio_total']) ?></p>
    
    <!-- Botón para volver al inicio -->
    <button onclick="window.location.href='index.php';" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Volver al Inicio
    </button>
</section>

<?php include 'footer.php'; ?>