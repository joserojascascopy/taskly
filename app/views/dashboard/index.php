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
            <!-- <button class="menu-toggle" id="menuToggle">&#9776;</button> -->
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
            <p>Hola: <span data-id="<?php echo $user_id; ?>"><?php echo $nombre; ?></span></p>
            <a class="logout-btn" href="/logout">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" x2="9" y1="12" y2="12" />
                </svg>
                Cerrar sesión
            </a>
        </header>

        <section class="projects">
            <h2>Mis Tareas</h2>
            <div class="filter-tasks">
                <span>Filtrar:</span>

                <label>
                    <input class="input-radio" type="radio" name="filter" value="todas" checked />
                    Todas
                </label>

                <label>
                    <input class="input-radio" type="radio" name="filter" value="pendiente" />
                    Pendientes
                </label>

                <label>
                    <input class="input-radio" type="radio" name="filter" value="completado" />
                    Completadas
                </label>
            </div>

            <div class="projects-container"></div>
        </section>
    </div>
</div>

<script src="/assets/js/menuToggle.js"></script>
<script src="/assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>