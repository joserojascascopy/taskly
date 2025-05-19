<div class="dashboard">
    <aside class="sidebar ocultar">
        <div class="nav-container">
            <img class="logo" src="/assets/img/taskly-logo.png" alt="Logo Taskly">
            <nav class="nav-links">
                <a href="/perfil">Perfil</a>
                <a href="/dashboard">Tareas</a>
                <a href="/crear-tarea">Crear Tarea</a>
            </nav>
        </div>
    </aside>

    <div class="main show">
        <header>
            <button class="menu-toggle" id="menuToggle">
                <svg class="hb" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" stroke="#000000" stroke-width=".6" fill="rgba(0,0,0,0)" stroke-linecap="round" style="cursor: pointer">
                    <path d="M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7">
                        <animate dur="0.2s" attributeName="d" values="M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7;M3,3L5,5L7,3M5,5L5,5M3,7L5,5L7,7" fill="freeze" begin="start.begin" />
                        <animate dur="0.2s" attributeName="d" values="M3,3L5,5L7,3M5,5L5,5M3,7L5,5L7,7;M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7" fill="freeze" begin="reverse.begin" />
                    </path>
                    <rect width="10" height="10" stroke="none">
                        <animate dur="2s" id="reverse" attributeName="width" begin="click" />
                    </rect>
                    <rect width="10" height="10" stroke="none">
                        <animate dur="0.001s" id="start" attributeName="width" values="10;0" fill="freeze" begin="click" />
                        <animate dur="0.001s" attributeName="width" values="0;10" fill="freeze" begin="reverse.begin" />
                    </rect>
                </svg>
            </button>
            <p>Hola: <span>José Rojas</span></p>
            <a class="logout-btn" href="/logout">Cerrar sesión</a>
        </header>
        <section class="crear-tarea">
            <h2>Crear nueva tarea</h2>
            <?php include_once __DIR__ . '/../components/alertas.php'; ?>
            <form class="tarea-form" method="POST">
                <div class="form-group">
                    <label for="titulo">Título de la tarea</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Ej: Diseñar landing page" />
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

<script src="/assets/js/menuToggle.js"></script>