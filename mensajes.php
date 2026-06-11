<main>
    <section>
        <div class="centro">
            <h2>Formulario de contacto</h2>
        </div>
    </section>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($mensaje_exito)): ?>
        <section class="contenedor-formulario" style="margin-bottom: 1rem;">
            <h3>Datos recibidos con POST</h3>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($_POST["nombre"] ?? "") ?></p>
            <p><strong>Correo:</strong> <?= htmlspecialchars($_POST["correo"] ?? "") ?></p>
            <?php if (!empty($_POST["comentario"])): ?>
                <p><strong>Comentario:</strong> <?= htmlspecialchars($_POST["comentario"]) ?></p>
            <?php endif; ?>
        </section>
    <?php elseif (isset($mensaje_error)): ?>
        <p class="error"><?= htmlspecialchars($mensaje_error) ?></p>
    <?php endif; ?>

    <section class="contenedor-formulario">
        <form method="POST" action="?page=mensajes">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre" required />

            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" name="correo" placeholder="correo@ejemplo.com" required />

            <label for="comentario">Comentario:</label>
            <textarea id="comentario" name="comentario" placeholder="Escribe tu comentario aquí..."></textarea>

            <div class="centro">
                <input class="boton" type="submit" value="Enviar" />
            </div>
        </form>
    </section>

    <section>
        <h2 class="centro">Opiniones recibidas</h2>
        <div class="contenedor-galeria">
            <?php if (empty($opiniones)): ?>
                <p class="centro">Aún no hay opiniones. ¡Sé el primero!</p>
            <?php else: ?>
                <?php foreach ($opiniones as $opinion): ?>
                    <div class="info-card" style="padding: 1rem; margin-bottom: 1rem;">
                        <strong style="color: var(--amarillo);"><?= htmlspecialchars($opinion["nombre"]) ?></strong>
                        <span style="color: var(--cyan); font-size:0.85rem;">(<?= htmlspecialchars($opinion["correo"] ?? "Sin correo") ?>)</span>
                        <p><?= htmlspecialchars($opinion["mensaje"]) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</main>
