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

        <section class="projects">
            <h2>Mis Tareas</h1>
                <div class="filter-tasks">
                    <span>Filtrar:</span>

                    <label>
                        <input type="radio" name="filter" value="todas" checked />
                        Todas
                    </label>

                    <label>
                        <input type="radio" name="filter" value="pendiente" />
                        Pendientes
                    </label>

                    <label>
                        <input type="radio" name="filter" value="completado" />
                        Completadas
                    </label>
                </div>

                <div class="projects-container">
                    <div class="project-card pendiente">
                        <div class="card-header">
                            <h2>Tarea A</h2>
                            <span class="estado">Pendiente</span>
                        </div>
                        <p>Gestión de tareas con PHP y JS</p>
                        <div class="overlay">
                            <div class="acciones">
                                <button class="btn-completar">Completado</button>
                                <button class="btn-eliminar">Eliminar</button>
                            </div>
                        </div>
                    </div>

                    <div class="project-card completado">
                        <div class="card-header">
                            <h2>Tarea B</h2>
                            <span class="estado">Completado</span>
                        </div>
                        <p>E-commerce con Tailwind y MySQL</p>
                        <div class="overlay">
                            <div class="acciones">
                                <button class="btn-completar">Completado</button>
                                <button class="btn-eliminar">Eliminar</button>
                            </div>
                        </div>
                    </div>

                    <div class="project-card pendiente">
                        <div class="card-header">
                            <h2>Tarea C</h2>
                            <span class="estado">Pendiente</span>
                        </div>
                        <p>App de recordatorios con WhatsApp API</p>
                        <div class="overlay">
                            <div class="acciones">
                                <button class="btn-completar">Completado</button>
                                <button class="btn-eliminar">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>