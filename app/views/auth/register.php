<div class="register-container">

    <div class="register-card">

        <div class="register-header">
            <img class="logo-card" src="/assets/img/taskly-logo.png" alt="Logo Taskly">
            <h1 class="card-title">Registrarse</h1>
            <p class="card-description">Ingresa tus datos para crear tu cuenta</p>
            <?php
            require_once __DIR__ . '/../components/alertas.php';
            ?>
        </div>

        <form action="/registrarse" method="POST" class="register-form">
            <div class="form-group">
                <div class="name-header">
                    <label for="nombre">Nombre</label>
                </div>
                <input type="text" id="nombre" name="nombre" placeholder="Tú nombre">
            </div>
            <div class="form-group">
                <div class="apellido-header">
                    <label for="apellido">Apellido</label>
                </div>
                <input type="text" id="apellido" name="apellido" placeholder="Tú apellido">
            </div>
            <div class="form-group">
                <div class="email-header">
                    <label for="email">Correo electrónico</label>
                </div>
                <input type="email" id="email" name="email" placeholder="correo@ejemplo.com">
            </div>
            <div class="form-group">
                <div class="password-header">
                    <label for="password">Contraseña</label>
                </div>
                <input type="password" id="password" name="password">
            </div>
            <input type="submit" value="Registrarse" class="btn-register">
        </form>

        <div class="register-footer">
            <p class="login-link">¿Ya tienes una cuenta? <a href="/">Inicia Sesión</a></p>
        </div>
        
    </div>
</div>