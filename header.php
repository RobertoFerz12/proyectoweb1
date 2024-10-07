<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Enlace a Font Awesome para usar los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Enlace a tu archivo de estilos CSS -->
    <link rel="stylesheet" href="style.css"> <!-- CSS general -->

    <?php if (isset($is_home) && $is_home): ?>
        <link rel="stylesheet" href="style_pag_ini.css"> <!-- CSS específico para la página de inicio -->
    <?php endif; ?>

    <title><?php echo isset($title) ? $title : 'Mi Sitio Web'; ?></title>
</head>
<body>

