<div class="reset-container">

    <div class="reset-card">

        <div class="reset-header">
            <img class="logo-card" src="/assets/img/taskly-logo.png" alt="Logo Taskly">
            <h1 class="card-title">Reestablecer Contraseña</h1>
            <p class="card-description">Introduzca su nueva contraseña.</p>
            <?php
            require_once __DIR__ . '/../components/alertas.php';
            if($error) {
                return;
            }
            ?>
        </div>
        <form method="POST" class="reset-form">
            <div class="form-group">
                <div class="password-header">
                    <label for="email">Nueva contraseña</label>
                </div>
                <input type="password" id="password" name="password">
            </div>
            <input type="submit" value="Restablecer Contraseña" class="btn-login">
        </form>

        <div class="reset-footer">
            <p class="reset-link">¿Recuperaste tu contraseña? <a href="/">Inicia Sesión</a></p>
        </div>
        
    </div>
</div>