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
            <p>Hola: <span><?php echo $nombre . " " . $apellido; ?></span></p>
            <a class="logout-btn" href="/logout">Cerrar sesión</a>
        </header>

        <section class="perfil">
            <h2>Mi perfil</h2>
            <?php include_once __DIR__ . '/../components/alertas.php'; ?>
            <form class="perfil-form" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre y Apellido</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre . " " . $apellido; ?>" />
                </div>

                <div class="form-group">
                    <label for="email">Correo Electronico</label>
                    <input type="text" id="email" name="email" value="<?php echo $email; ?>" />
                </div>

                <input type="submit" class="btn-actualizar" value="Actualizar Perfil">

            </form>
        </section>

    </div>
</div>

<script src="/assets/js/menuToggle.js"></script>