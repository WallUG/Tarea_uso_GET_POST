<?php
$archivo_opiniones = __DIR__ . "/opiniones.json";

function cargarOpiniones($archivo): array {
    if (!file_exists($archivo)) {
        file_put_contents($archivo, "[]");
        return [];
    }
    return json_decode(file_get_contents($archivo), true) ?? [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $comentario = trim($_POST["comentario"] ?? "");
    if ($nombre !== "" && $correo !== "") {
        $opiniones = cargarOpiniones($archivo_opiniones);
        $opiniones[] = ["nombre" => $nombre, "correo" => $correo, "mensaje" => $comentario];
        file_put_contents($archivo_opiniones, json_encode($opiniones, JSON_PRETTY_PRINT));
        $mensaje_exito = "Datos enviados correctamente";
    } else {
        $mensaje_error = "Todos los campos son obligatorios";
    }
}

$opiniones = cargarOpiniones($archivo_opiniones);

$page = $_GET["page"] ?? "inicio";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Pelicula Favorita</title>
    <link rel="preload" href="css/normalize.css" as="style" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="preload" href="css/styles.css" as="style" />
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <header>
        <?php if ($page === "inicio"): ?>
        <section class="contenedor-opiniones">
            <div id="lista-mensajes" class="carrusel-mensajes">
                <?php if (empty($opiniones)): ?>
                    <div class="mensaje-item">Aún no hay opiniones. ¡Sé el primero!</div>
                <?php else: ?>
                    <?php foreach ($opiniones as $opinion): ?>
                        <div class="mensaje-item">
                            <span><?= htmlspecialchars($opinion["nombre"]) ?>:</span>
                            <?= htmlspecialchars($opinion["mensaje"]) ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>

        <section>
            <div>
                <h1 id="titulo-pelicula">Project Hail Mary</h1>
            </div>
        </section>
    </header>

    <section>
        <div class="nav-bg"></div>
            <nav class="navegacion-principal contenedor">
                <a href="?page=inicio">Inicio</a>
                <a href="?page=galeria">Galería</a>
                <a href="?page=mensajes">Opiniones</a>
            </nav>
        </div>
    </section>

    <p style="text-align:center; margin-top:1rem;">
        <strong>Sección seleccionada:</strong> <?= htmlspecialchars(ucfirst($page)) ?>
    </p>

    <?php
    if ($page === "inicio") {
        include "inicio.php";
    } elseif ($page === "galeria") {
        include "galeria.php";
    } elseif ($page === "mensajes") {
        include "mensajes.php";
    }
    ?>

    <footer>
        <div>
            <p class="centro">© 2026 Mi Pelicula Favorita BY Gustavo. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>
