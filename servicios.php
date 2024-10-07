<?php
include 'conexion.php';
$title = 'Servicios';
include 'header.php';
include 'menu.php';

// Inicializar variables
$articulo = '';
$tela = '';
$tiempo = '';
$nombre = ''; // Nueva variable para el nombre
$precio_total = 0;

// Obtener precios de artículos
$sqlArticulos = "SELECT servicio, precio FROM precios_servicios WHERE categoria='articulo'";
$resultArticulos = $conn->query($sqlArticulos);

// Obtener precios de telas
$sqlTelas = "SELECT servicio, precio FROM precios_servicios WHERE categoria='tela'";
$resultTelas = $conn->query($sqlTelas);

// Obtener precios de tiempos
$sqlTiempos = "SELECT servicio, precio FROM precios_servicios WHERE categoria='tiempo'";
$resultTiempos = $conn->query($sqlTiempos);

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['finalizar'])) {
    $nombre = $_POST['nombre']; // Obtener el nombre
    $articulo = $_POST['articulo'];
    $tela = $_POST['tela'];
    $tiempo = $_POST['tiempo'];

    // Obtener precios
    $precioArticulo = $conn->query("SELECT precio FROM precios_servicios WHERE servicio='$articulo' AND categoria='articulo'")->fetch_assoc()['precio'];
    $precioTela = $conn->query("SELECT precio FROM precios_servicios WHERE servicio='$tela' AND categoria='tela'")->fetch_assoc()['precio'];
    $precioTiempo = $conn->query("SELECT precio FROM precios_servicios WHERE servicio='$tiempo' AND categoria='tiempo'")->fetch_assoc()['precio'];

    // Calcular el precio total
    $precio_total = $precioArticulo + $precioTela + $precioTiempo;

    // Preparar la consulta para insertar los datos
    $sql = "INSERT INTO cotizaciones (nombre, articulo, tela, tiempo, precio_total) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssd", $nombre, $articulo, $tela, $tiempo, $precio_total);

    if ($stmt->execute()) {
        // Redirigir a detalle_cotizacion.php con el id de la cotización
        $cotizacion_id = $conn->insert_id; // Obtener el id de la cotización recién insertada
        header("Location: detalle_cotizacion.php?id=$cotizacion_id");
        exit();
    } else {
        echo "<p>Error al guardar la cotización: " . $conn->error . "</p>";
    }

    $stmt->close();
}
?>

<section id="servicios">
    <h2>Nuestros Servicios</h2>
    <h3>Cotización de Tapicería</h3>

    <form id="form1" onsubmit="return false;">
        <h3>Ingresa tu nombre:</h3>
        <input type="text" name="nombre" id="nombre" required placeholder="Nombre completo">
        
        <h3>¿Qué deseas tapizar?</h3>
        <?php while ($row = $resultArticulos->fetch_assoc()): ?>
            <label style="display: flex; align-items: center;">
                <img src="img/<?= strtolower($row['servicio']) ?>.jpg" alt="<?= $row['servicio'] ?>" class="imagen-circulo">
                <input type="radio" name="articulo" value="<?= $row['servicio'] ?>" required> <?= $row['servicio'] ?> ($<?= $row['precio'] ?>)
            </label><br>
        <?php endwhile; ?>
        <button type="button" onclick="nextStep(1)">Siguiente</button>
    </form>

    <div id="step2" style="display:none;">
        <h3>Selecciona el tipo de tela:</h3>
        <?php while ($row = $resultTelas->fetch_assoc()): ?>
            <label style="display: flex; align-items: center;">
                <img src="img/<?= strtolower($row['servicio']) ?>.jpg" alt="<?= $row['servicio'] ?>" class="imagen-circulo">
                <input type="radio" name="tela" value="<?= $row['servicio'] ?>" required> <?= $row['servicio'] ?> ($<?= $row['precio'] ?>)
            </label><br>
        <?php endwhile; ?>
        <button type="button" onclick="nextStep(2)">Siguiente</button>
        <button type="button" onclick="previousStep(1)">Retroceder</button>
        <button type="button" onclick="salir()">Salir</button>
    </div>

    <div id="step3" style="display:none;">
        <h3>¿En cuánto tiempo lo necesitas?</h3>
        <?php while ($row = $resultTiempos->fetch_assoc()): ?>
            <label style="display: flex; align-items: center;">
                <img src="img/<?= strtolower($row['servicio']) ?>.jpg" alt="<?= $row['servicio'] ?>" class="imagen-circulo">
                <input type="radio" name="tiempo" value="<?= $row['servicio'] ?>" required> <?= $row['servicio'] ?> (+$<?= $row['precio'] ?>)
            </label><br>
        <?php endwhile; ?>
        <button type="button" onclick="finalizarCotizacion()">Finalizar Cotización</button>
        <button type="button" onclick="previousStep(2)">Retroceder</button>
        <button type="button" onclick="salir()">Salir</button>
    </div>

    <div id="resultado" style="display:none;">
        <h3>Resultado de la Cotización</h3>
        <p id="totalCotizacion"></p>
        <form method="post" action="">
            <input type="hidden" name="articulo" id="hidden_articulo">
            <input type="hidden" name="tela" id="hidden_tela">
            <input type="hidden" name="tiempo" id="hidden_tiempo">
            <input type="hidden" name="precio_total" id="hidden_precio_total">
            <input type="hidden" name="nombre" id="hidden_nombre"> <!-- Campo oculto para el nombre -->
            <button type="submit" name="finalizar">Guardar Cotización</button>
        </form>
        <button type="button" onclick="previousStep(3)">Modificar Cotización</button>
        <button type="button" onclick="salir()">Salir</button>
    </div>

    <script>
        // Definir precios para el cálculo
        const preciosArticulos = {};
        const preciosTelas = {};
        const preciosTiempo = {};

        <?php
            // Generar JavaScript para precios de artículos
            $resultArticulos->data_seek(0); // Reiniciar el puntero del resultado
            while ($row = $resultArticulos->fetch_assoc()) {
                echo "preciosArticulos['" . $row['servicio'] . "'] = " . $row['precio'] . ";\n";
            }

            // Generar JavaScript para precios de telas
            $resultTelas->data_seek(0); // Reiniciar el puntero del resultado
            while ($row = $resultTelas->fetch_assoc()) {
                echo "preciosTelas['" . $row['servicio'] . "'] = " . $row['precio'] . ";\n";
            }

            // Generar JavaScript para precios de tiempos
            $resultTiempos->data_seek(0); // Reiniciar el puntero del resultado
            while ($row = $resultTiempos->fetch_assoc()) {
                echo "preciosTiempo['" . $row['servicio'] . "'] = " . $row['precio'] . ";\n";
            }
        ?>

        function finalizarCotizacion() {
            const articulo = document.querySelector('input[name="articulo"]:checked').value;
            const tela = document.querySelector('input[name="tela"]:checked').value;
            const tiempo = document.querySelector('input[name="tiempo"]:checked').value;
            const nombre = document.getElementById('nombre').value; // Obtener el nombre

            const precioArticulo = preciosArticulos[articulo];
            const precioTela = preciosTelas[tela];
            const precioTiempo = preciosTiempo[tiempo];
            const total = precioArticulo + precioTela + precioTiempo;

            // Mostrar resultado
            document.getElementById('step3').style.display = 'none';
            document.getElementById('resultado').style.display = 'block';
            document.getElementById('totalCotizacion').innerText = `Artículo: ${articulo}, Tela: ${tela}, Tiempo: ${tiempo}, Total: $${total}`;

            // Guardar datos en inputs ocultos
            document.getElementById('hidden_articulo').value = articulo;
            document.getElementById('hidden_tela').value = tela;
            document.getElementById('hidden_tiempo').value = tiempo;
            document.getElementById('hidden_precio_total').value = total;
            document.getElementById('hidden_nombre').value = nombre; // Guardar el nombre en input oculto
        }

        function nextStep(step) {
            if (step === 1) {
                document.getElementById('form1').style.display = 'none';
                document.getElementById('step2').style.display = 'block';
            } else if (step === 2) {
                document.getElementById('step2').style.display = 'none';
                document.getElementById('step3').style.display = 'block';
            }
        }

        function previousStep(step) {
            if (step === 2) {
                document.getElementById('step2').style.display = 'none';
                document.getElementById('form1').style.display = 'block';
            } else if (step === 3) {
                document.getElementById('step3').style.display = 'none';
                document.getElementById('step2').style.display = 'block';
            }
        }

        function salir() {
            // Aquí puedes implementar la lógica para salir o redirigir a otra página
            window.location.href = 'index.php'; // Ejemplo: redirigir a la página de inicio
        }
    </script>
</section>

<?php include 'footer.php'; ?>








