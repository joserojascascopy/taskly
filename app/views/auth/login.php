<div class="login-container">

    <div class="login-card">

        <div class="login-header">
            <img class="logo-card" src="/assets/img/taskly-logo.png" alt="Logo Taskly">
            <h1 class="card-title">Iniciar Sesion</h1>
            <p class="card-description">Ingresa tus credenciales para acceder a tu cuenta</p>
        </div>

        <form action="/" method="POST" class="login-form">
            <div class="form-group">
                <div class="email-header">
                    <label for="email">Correo electrónico</label>
                </div>
                <input type="email" id="email" name="email" placeholder="correo@ejemplo.com">
            </div>
            <div class="form-group">
                <div class="password-header">
                    <label for="password">Contraseña</label>
                    <a href="#" class="forgot">¿Olvidaste tu contraseña?</a>
                </div>
                <input type="password" id="password" name="password">
            </div>
            <input type="submit" value="Iniciar Sesión" class="btn-login">
        </form>

        <div class="login-footer">
            <p class="register-link">¿No tienes una cuenta? <a href="/registrarse">Registrate</a></p>
        </div>
        
    </div>
</div>