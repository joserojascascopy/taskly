<div class="forgot-container">

    <div class="forgot-card">

        <div class="forgot-header">
            <img class="logo-card" src="/assets/img/taskly-logo.png" alt="Logo Taskly">
            <h1 class="card-title">Olvidé mi contraseña</h1>
            <p class="card-description">Introduce tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>
            <?php
            require_once __DIR__ . '/../components/alertas.php';
            ?>
        </div>

        <form method="POST" class="forgot-form">
            <div class="form-group">
                <div class="email-header">
                    <label for="email">Correo electrónico</label>
                </div>
                <input type="email" id="email" name="email" placeholder="correo@ejemplo.com">
            </div>
            <input type="submit" value="Enviar enlace" class="btn-login">
        </form>

        <div class="forgot-footer">
            <p class="forgot-link">¿Recuperaste tu contraseña? <a href="/">Inicia Sesión</a></p>
        </div>
        
    </div>
</div>