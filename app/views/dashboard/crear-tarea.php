<div class="dashboard">
    <aside class="sidebar">
        <div class="nav-container">
            <img class="logo" src="/assets/img/taskly-logo.png" alt="Logo Taskly">
            <nav class="nav-links">
                <a href="#">Perfil</a>
                <a href="/dashboard">Tareas</a>
                <a href="/crear-tarea">Crear Tarea</a>
            </nav>
        </div>
    </aside>

    <div class="main">
        <header>
            <button class="menu-toggle" id="menuToggle">&#9776;</button>
            <p>Hola: <span>José Rojas</span></p>
            <a class="logout-btn" href="/logout">Cerrar sesión</a>
        </header>
        <section class="crear-tarea">
            <h2>Crear nueva tarea</h2>
            <?php include_once __DIR__ . '/../components/alertas.php'; ?>
            <form class="tarea-form" method="POST">
                <div class="form-group">
                    <label for="titulo">Título de la tarea</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Ej: Diseñar landing page"/>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Breve descripción de la tarea..." rows="4"></textarea>
                </div>
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
                <input type="submit" class="btn-crear" value="Crear Tarea">
            </form>
        </section>
    </div>
</div>